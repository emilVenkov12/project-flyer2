<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Http\Requests\FlyerRequest;
use App\Http\Requests\ChangeFlyerRequest;
use App\Flyer;
use App\Photo;

class FlyersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(FlyerRequest $request)
    {
        //persist the flyer data
        $flyer = Flyer::create($request->all());
        
        flash()->success('Success!', 'Your flyer has been created!');

        return redirect("{$flyer->zip}/{$flyer->street}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * Apply photo for the referenced flyer.
     * @param string  $zip
     * @param string  $street
     * @param Request $request
     */
    public function addPhoto($zip, $street, ChangeFlyerRequest $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        if (! $this->userCreatedFlyer($request)) 
        {
            return $this->unauthorized($request);
        }

        $photo = $this->makePhoto($request->file('photo'));

         Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => $this->user->id
        ])->exists();
    }

    protected function unauthorized(Request $request)
    {    
        if ($request->ajax()) {
            return response(['message' => 'No Way.'], 403);
        }

        flash('No Way');
        
        return redirect('/');
    }

    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
