<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Licence, App\Models\Category, App\Models\Region;

class LicenceController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryBuilder = Licence::select('*');
        if ($request->has('c') && $request->input('c')) {
          $queryBuilder->where('category', $request->input('c'));  
        }
        if ($request->has('p') && $request->input('p')) {
            switch ($request->input('p')) {
                case 1:
                    $queryBuilder->whereBetween('price', [10, 20]);  
                    break;
                case 2:
                    $queryBuilder->whereBetween('price', [20, 50]);  
                    break;
                case 3:
                    $queryBuilder->whereBetween('price', [50, 100]);  
                    break;
                case 4:
                    $queryBuilder->whereBetween('price', [100, 200]);  
                    break;
                case 5:
                    $queryBuilder->where('price', '>', 200);  
                    break;
            }
        }

        return view('mobile.licences.index')
            ->with([
                'licences' => $queryBuilder->get(),
                'categories' => Category::lists('name', 'id'),
                'regions' => Region::lists('name', 'id')
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobile.licences.create')
            ->with([
                'categories' => Category::lists('name', 'id'),
                'regions' => Region::lists('name', 'id'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //
        ]);

        Licence::create($request->all());

        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('mobile.licences.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}