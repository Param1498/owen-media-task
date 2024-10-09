<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OwenMediaRegistration;
use Illuminate\Support\Facades\Hash;

class OwenMediaController extends Controller
{
    /**
     * Handle the registration of a new OwenMedia user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:owen_media_registrations,email',
            'gender' => 'required|in:Male,Female',
            'password' => 'required|string|regex:/[!@#$%^&*()_+]/',
            'pdf_file' => 'required|file|mimes:pdf|max:1024', // 1MB
        ]);

        // Saving the pdf file from the request
        $pdfFilePath = $request->file('pdf_file')->store('owen_media_pdfs', 'public');

        // Creating a new UserRegistration instance/Object to save request data in database
        $obj_user_registration = new OwenMediaRegistration();
        $obj_user_registration->name = $request->name;
        $obj_user_registration->email = $request->email;
        $obj_user_registration->gender = $request->gender;
        $obj_user_registration->password = Hash::make($request->password); 
        $obj_user_registration->file_path = $pdfFilePath;

        // Saving the data to the database
        $obj_user_registration->save();
        // Returing a success message for view file
        return redirect()->back()->with('success', 'Registrar successfully');
}
}
