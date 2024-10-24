<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use Illuminate\Http\Request;
use App\Http\Requests\ScholarshipApplicationRequest;

class ScholarshipController extends Controller
{
    /**
     * Generate random IPK between 2.5 and 4.0
     * Dengan probabilitas:
     * - 30% chance untuk IPK < 3.0
     * - 70% chance untuk IPK >= 3.0
     */
    private function generateRandomIpk()
    {
        // Generate random number 1-100
        $chance = rand(1, 100);
        
        if ($chance <= 30) {
            // 30% chance untuk IPK < 3.0
            // Generate IPK antara 2.5 - 2.99
            $ipk = rand(250, 299) / 100;
        } else {
            // 70% chance untuk IPK >= 3.0
            // Generate IPK antara 3.0 - 4.0
            $ipk = rand(300, 400) / 100;
        }

        return $ipk;
    }

    public function index()
    {
        $scholarships = Scholarship::all();
        return view('scholarships.index', compact('scholarships'));
    }

    public function create($scholarship_id = null)
    {
        $scholarships = Scholarship::all();
        
        // Generate random IPK
        $ipk = $this->generateRandomIpk();
        
        // Store IPK in session untuk konsistensi
        session(['current_ipk' => $ipk]);
        
        // Jika scholarship_id ada dan IPK memenuhi syarat
        $selectedScholarship = null;
        if ($scholarship_id && $ipk >= 3.0) {
            $selectedScholarship = Scholarship::find($scholarship_id);
        }
        
        return view('scholarships.create', compact('scholarships', 'ipk', 'selectedScholarship'));
    }

    public function store(Request $request)
    {
        // Ambil IPK dari session
        $ipk = session('current_ipk', 0);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'semester' => 'required|integer|between:1,8',
            'scholarship_id' => 'required_if:ipk,>=,3',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,zip|max:2048',
        ]);

        if ($ipk < 3.0) {
            return back()->with('error', 'IPK Anda tidak memenuhi syarat minimum (minimal 3.0).');
        }

        $documentPath = $request->file('document')->store('documents', 'public');

        ScholarshipApplication::create([
            'scholarship_id' => $request->scholarship_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'semester' => $request->semester,
            'ipk' => $ipk,
            'document_path' => $documentPath,
            'status' => 'belum di verifikasi'
        ]);

        // Clear IPK from session after successful submission
        session()->forget('current_ipk');

        return redirect()->route('scholarships.results')
            ->with('success', 'Pendaftaran beasiswa berhasil!');
    }

    public function results()
    {
        $applications = ScholarshipApplication::with('scholarship')->get();
        return view('scholarships.results', compact('applications'));
    }

    // Endpoint untuk debug/testing
    public function checkIpk()
    {
        $newIpk = $this->generateRandomIpk();
        return response()->json([
            'ipk' => $newIpk,
            'eligible' => $newIpk >= 3.0
        ]);
    }
}