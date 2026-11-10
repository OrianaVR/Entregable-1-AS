/**
 * @author Nawal Oriana Valoyes Renteria
 */

document.addEventListener('DOMContentLoaded', function () {
    const messageSource = document.getElementById('formMessages');

    if (messageSource === null) {
        return;
    }

    const messages = messageSource.dataset;
    const skippedTypes = ['hidden', 'submit', 'button', 'reset'];

    const fillMessage = function (template, values) {
        return Object.keys(values).reduce(function (text, key) {
            return text.replace(':' + key, values[key]);
        }, template);
    };

    const resolveFileMessage = function (field) {
        if (field.files.length === 0) {
            return '';
        }

        const file = field.files[0];
        const maxKb = Number(field.dataset.maxKb || 0);

        if (field.accept === 'image/*' && !file.type.startsWith('image/')) {
            return messages.image;
        }

        if (maxKb > 0 && file.size > maxKb * 1024) {
            return fillMessage(messages.fileSize, { size: maxKb });
        }

        return '';
    };

    const resolveMessage = function (field) {
        const validity = field.validity;
        const hasDecimalStep = field.step !== '' && field.step !== '1' && field.step !== 'any';

        if (validity.valueMissing) {
            return messages.required;
        }
        if (validity.typeMismatch) {
            return field.type === 'email' ? messages.email : messages.number;
        }
        if (validity.patternMismatch) {
            return field.dataset.patternMessage || messages.invalid;
        }
        if (validity.badInput) {
            return messages.number;
        }
        if (validity.tooShort) {
            return fillMessage(messages.minLength, { min: field.minLength });
        }
        if (validity.tooLong) {
            return fillMessage(messages.maxLength, { max: field.maxLength });
        }
        if (validity.rangeUnderflow) {
            return fillMessage(messages.min, { min: field.min });
        }
        if (validity.rangeOverflow) {
            return fillMessage(messages.max, { max: field.max });
        }
        if (validity.stepMismatch) {
            return hasDecimalStep ? messages.decimals : messages.wholeNumber;
        }
        if (field.type === 'file') {
            return resolveFileMessage(field);
        }
        if (!validity.valid) {
            return messages.invalid;
        }

        return '';
    };

    const findFeedback = function (field) {
        return field.parentElement.querySelector('.invalid-feedback[data-field-error="' + field.name + '"]');
    };

    const buildFeedback = function (field, message) {
        const feedback = document.createElement('div');
        const icon = document.createElement('i');
        const text = document.createElement('span');

        feedback.className = 'invalid-feedback d-block fw-semibold';
        feedback.dataset.fieldError = field.name;
        icon.className = 'bi bi-exclamation-circle me-1';
        text.textContent = message;
        feedback.append(icon, text);
        field.insertAdjacentElement('afterend', feedback);

        return feedback;
    };

    const renderField = function (field) {
        const message = resolveMessage(field);
        const feedback = findFeedback(field);

        if (message === '') {
            if (feedback !== null) {
                feedback.remove();
            }
            field.classList.remove('is-invalid');
            field.classList.toggle('is-valid', field.value !== '');

            return true;
        }

        field.classList.remove('is-valid');
        field.classList.add('is-invalid');

        if (feedback === null) {
            buildFeedback(field, message);
        } else {
            feedback.querySelector('span').textContent = message;
        }

        return false;
    };

    document.querySelectorAll('form[data-live-validate]').forEach(function (form) {
        const fields = Array.from(form.querySelectorAll('input, select, textarea')).filter(function (field) {
            return !skippedTypes.includes(field.type) && !field.disabled && !field.readOnly;
        });

        fields.forEach(function (field) {
            if (field.dataset.digitsOnly !== undefined) {
                field.addEventListener('input', function () {
                    field.value = field.value.replace(/\D/g, '');
                });
            }

            ['input', 'change', 'blur'].forEach(function (eventName) {
                field.addEventListener(eventName, function () {
                    renderField(field);
                });
            });
        });

        form.addEventListener('submit', function (event) {
            let firstInvalid = null;

            fields.forEach(function (field) {
                if (!renderField(field) && firstInvalid === null) {
                    firstInvalid = field;
                }
            });

            if (firstInvalid !== null) {
                event.preventDefault();
                firstInvalid.focus();
            }
        });
    });
});