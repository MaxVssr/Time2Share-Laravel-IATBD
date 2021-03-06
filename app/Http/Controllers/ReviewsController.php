<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Exception;

class ReviewsController extends Controller
{
    public function createReview() {
        return view('reviews.create', [
            'products' => Product::all(),
        ]);
    }

    public function storeReview(Request $request, Review $review) {
        $review->product_name = $request->input('product_name');
        $review->lender_email = $request->user()['email'];
        $review->review_content = $request->input('review_content');

        try{
            $review->save();
            return redirect('/');
        } catch(Exception $e) {
            return redirect('/reviews/create');
        }
    }
}
