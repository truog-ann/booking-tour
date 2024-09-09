<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelComment;
use App\Models\User;
use Illuminate\Http\Request;

class Hotel_CommentController extends Controller
{
    //
    public function index()
    {
        $hotelComments = HotelComment::all();
        return view('admin.Hotel_comments.index', compact('hotelComments'));
    }


    public function create()
    {
        $hotels = Hotel::all();
        $users = User::all();
        return view('admin.Hotel_comments.add', compact('hotels', 'users'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'comments' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'user_id' => 'required|exists:users,id'
        ]);

        HotelComment::create($request->all());

        return redirect()->route('hotel_comments.index')
                        ->with('success','Hotel comment created successfully.');
    }

  
    public function show(HotelComment $hotelComment)
    {
        return view('admin.Hotel_comments.show', compact('hotelComment'));
    }


    public function edit(HotelComment $hotelComment)
    {
        $hotels = Hotel::all();
        $users = User::all();
        return view('admin.Hotel_comments.edit', compact('hotelComment', 'hotels', 'users'));
    }

   
    public function update(Request $request, HotelComment $hotelComment)
    {
        $request->validate([
            'comments' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $hotelComment->update($request->all());

        return redirect()->route('hotel_comments.index')
                        ->with('success','Hotel comment updated successfully');
    }
    public function destroy(HotelComment $hotelComment)
    {
        $hotelComment->delete();

        return redirect()->back()
                        ->with('success','Hotel comment deleted successfully');
    }

}
