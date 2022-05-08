<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // functia care salveaza review-ul utilizatorului
    public function ReviewStore(Request $request)
    {

        // $product preia id-ul produsului din formular
        $product = $request->product_id;

        // validare ca atat titlul cat si cuprinsul recenziei sunt necesare
        $request->validate(
            [
                'summary' => 'required',
                'comment' => 'required',
            ],
            // mesaje pentru validare recenzii
            [
                'summary.required' => 'Titlul recenziei este necesar',
                'comment.required' => 'Cuprinsul recenziei este necesar',
            ]
        );
        // inseram review-ul in tabelul reviews
        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'rating' => $request->rating,
            'created_at' => Carbon::now(),

        ]);
        // returnameaza pagina de product cu review-ul adaugat
        $notification = array(
            'message' => 'Recenzia a fost adaugata! Va apare dupa validarea administratorului',
            'alert-type' => 'success'
        );
        // returneaza pagina de product cu review-ul adaugat
        return redirect()->back()->with($notification);
    }
}