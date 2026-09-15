document.addEventListener('DOMContentLoaded', function () {
    var container = document.getElementById('starRating');

    if (!container) {
        return;
    }

    var input = document.getElementById('ratingInput');
    var buttons = container.querySelectorAll('.star-btn');

    function paint(value) {
        buttons.forEach(function (button) {
            var icon = button.querySelector('i');
            var isFilled = parseInt(button.dataset.value, 10) <= value;
            icon.classList.toggle('bi-star-fill', isFilled);
            icon.classList.toggle('bi-star', !isFilled);
        });
    }

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            var value = parseInt(button.dataset.value, 10);
            input.value = value;
            paint(value);
        });
    });

    paint(parseInt(input.value, 10));
});
