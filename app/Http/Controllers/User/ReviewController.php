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
                'rating' => 'required',
            ],
            // mesaje pentru validare recenzii
            [
                'summary.required' => 'Titlul recenziei este necesar',
                'comment.required' => 'Cuprinsul recenziei este necesar',
                'rating.required' => 'Ratingul recenziei este necesar',
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

    // functia de vizualizare a recenziilor in asteptare
    public function PendingReview()
    {
        // $reviewpreia din tabelul reviews toate recenzile in asteptare cu status 0 
        $review = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        // returneaza pagina de recenzii in asteptare cu datele din $review
        return view('backend.review.pending_review', compact('review'));
    }
    // functia de vizualizare detalii recenzie in asteptare
    public function PendingReviewDetails($id)
    {
        // $reviewpreia din tabelul reviews recenzia cu id-ul $id
        $pending_review = Review::find($id);
        // afiseaza pagina de recenzii in asteptare cu datele din $pending_review
        return view('backend.review.pending_review_details', compact('pending_review'));
    }
    // functia de actualizare a recenziei in asteptare
    public function ReviewApprove($id)
    {
        // actualizam statusul recenziei cu 1 pentru recenzia cu id-ul $id
        Review::where('id', $id)->update(['status' => 1]);
        // mesaj de notificare pentru aprobare recenziei
        $notification = array(
            'message' => 'Recenzia a fost aprobata!',
            'alert-type' => 'success'
        );
        // returneaza pagina de recenzii in asteptare cu mesajul de notificare
        return redirect()->route('pending.review')->with($notification);
    }
}