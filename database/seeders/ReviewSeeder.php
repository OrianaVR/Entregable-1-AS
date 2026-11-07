<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->orderBy('id')->get();

        if ($users->isEmpty()) {
            return;
        }

        $reviewsByProduct = [
            'Gentle Foaming Cleanser' => [
                [4, 'Super gentle and my skin never feels tight afterwards.'],
                [3, 'Nice soft foam, but it does not remove heavy makeup on its own.'],
                [4, 'Good for sensitive skin, it calmed the redness I had with my old cleanser.'],
            ],
            'Hydrating Amino Gel Cleanser' => [
                [4, 'Feels fresh and leaves my face soft. Great for the morning routine.'],
                [3, 'Cleans well but I need a second wash when I wear sunscreen.'],
            ],
            'Micellar Cleansing Water' => [
                [5, 'Takes off waterproof mascara in seconds without rubbing. A must have.'],
                [5, 'I use it every night before my cleanser, it never irritates my eyes.'],
                [4, 'Works great, I just wish the bottle came with a pump.'],
            ],
            'Toleriane Hydrating Gentle Cleanser' => [
                [4, 'Creamy and comforting, ideal for my dry skin during cold weather.'],
                [3, 'Does not strip my skin, but it does not foam and I miss that clean feeling.'],
            ],
            'Vitamin C Glow Serum' => [
                [5, 'After three weeks my dark spots look lighter and my skin is brighter.'],
                [4, 'Absorbs fast and layers well under moisturizer. It tingles a little at first.'],
                [5, 'My favorite morning step, my skin looks glowy even without makeup.'],
            ],
            'Hyaluronic Acid Hydration Booster' => [
                [4, 'Lightweight and not sticky. I apply it on damp skin for the best results.'],
                [3, 'Hydrates for a few hours, but I need a cream on top by the afternoon.'],
            ],
            'Niacinamide 10% + Zinc 1% Serum' => [
                [4, 'My pores look smaller and my T-zone is less oily by midday.'],
                [4, 'Helped with my breakouts, although the results took about a month.'],
                [3, 'It works, but it pills if I use too much under sunscreen.'],
            ],
            'Retinol 0.5% Night Serum' => [
                [4, 'Smoother texture after a month. I started using it twice a week.'],
                [3, 'It works, but my skin got a little dry during the first two weeks.'],
            ],
            'Barrier Repair Moisture Cream' => [
                [5, 'Rich but not greasy, it saved my skin after a sunburn.'],
                [5, 'The best cream for dry patches, a little goes a long way.'],
                [4, 'Very nourishing, I prefer it at night because it feels heavy in the morning.'],
            ],
            'Ultra-Light Water Gel Cream' => [
                [4, 'Perfect for oily skin in Medellín weather, it feels like water.'],
                [3, 'Hydrates without shine, but it is not enough for my dry areas.'],
            ],
            'Double Repair Face Moisturizer' => [
                [5, 'My go-to moisturizer, it calms my skin and keeps it hydrated all day.'],
                [4, 'Simple and effective. No fragrance, which I love.'],
                [5, 'Dermatologist recommended it and now I understand why.'],
            ],
            'Invisible Daily Defense SPF 50' => [
                [4, 'Truly invisible, no white cast on my skin tone.'],
                [3, 'Light texture, but my skin looks a bit shiny by noon.'],
            ],
            'Fusion Water Sunscreen SPF 50' => [
                [5, 'The lightest sunscreen I have tried, it absorbs instantly.'],
                [5, 'It does not sting my eyes and it is perfect for everyday use.'],
                [4, 'Great finish, I only wish the tube were bigger.'],
            ],
            'UVmune 400 Fluid SPF 50+' => [
                [4, 'Very high protection and still feels light. Perfect for the beach.'],
                [3, 'Protects really well, but the dewy finish is too much for my oily skin.'],
            ],
        ];

        $userIndex = 0;

        foreach ($reviewsByProduct as $productName => $reviews) {
            $product = Product::where('name', $productName)->first();

            if ($product === null) {
                continue;
            }

            foreach ($reviews as [$rating, $comment]) {
                $review = new Review;
                $review->setRating($rating);
                $review->setComment($comment);
                $review->setUserId($users[$userIndex % $users->count()]->getId());
                $review->setProductId($product->getId());
                $review->save();

                $userIndex++;
            }

            $product->setFeatured($product->getAverageRating() >= 4);
            $product->save();
        }
    }
}
