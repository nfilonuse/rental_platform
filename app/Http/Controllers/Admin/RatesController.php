<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Rates as Rates;
use HertzApi\Model\Companies as Companies;
use HertzApi\Model\Accounts as Accounts;
use HertzApi\Model\Packages as Packages;
use HertzApi\Model\Areas as Areas;
use HertzApi\Model\Sipps as Sipps;
use HertzApi\Model\SippCompanies as SippCompanies;

class RatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the nerds
        $rates = Rates::all();

        // load the view and pass the nerds
        return view('admin.rates.index')
            ->with('rates', $rates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rates.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
        ]);

		if (isset($request['disable'])) $request['disable']=1; else $request['disable']=0;
        Rates::create($request->all());

        // get all the nerds
        $rates = Rates::all();

        return redirect()->route('admin.rates.index')
        				 ->with('success','Location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Rates::find($id);
        return view('admin.rates.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = Rates::find($id);
        return view('admin.rates.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
        ]);

		if (isset($request['disable'])) $request['disable']=1; else $request['disable']=0;
        Rates::find($id)->update($request->all());

        // get all the nerds
        $rates = Rates::all();
        return redirect()->route('admin.rates.index')
        				 ->with('success','Location update successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editaccounts($id)
    {
        $item = Rates::find($id);
        $accounts = Accounts::all();
        return view('admin.rates.editaccounts',compact('item'),compact('accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateaccounts(Request $request, $id)
    {
        $rate=Rates::find($id);

		$rate->accounts()->sync($request->input('accounts'));;

        return redirect()->route('admin.rates.index')
        				 ->with('success','Location update successfully');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editpackages($id)
    {
        $item = Rates::find($id);
        $packages = Packages::all();
        return view('admin.rates.editpackages',compact('item'),compact('packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatepackages(Request $request, $id)
    {
        $rate=Rates::find($id);

		$rate->packages()->sync($request->input('packages'));;

        return redirect()->route('admin.rates.index')
        				 ->with('success','Package update successfully');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editsipps($id)
    {
        $companies=array();
        $item = Rates::with('accounts')->find($id);
        foreach ($item->accounts as $account)
        {
            $companies[]=$account->company_id;
        }
        $companies=array_unique($companies);
        $sipps=SippCompanies::whereIn('company_id',$companies)->pluck('sipp_id')->toArray();;
        $sipps = Sipps::whereIn('id',$sipps)->get();
        return view('admin.rates.editsipps',compact('item'),compact('sipps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatesipps(Request $request, $id)
    {
        $rate=Rates::find($id);

		$rate->sipps()->sync($request->input('sipps'));;

        return redirect()->route('admin.rates.index')
        				 ->with('success','Package update successfully');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editareas($id)
    {
        $item = Rates::find($id);
        $areas = Areas::all();
        return view('admin.rates.editareas',compact('item'),compact('areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateareas(Request $request, $id)
    {
        $rate=Rates::find($id);

		$rate->areas()->sync($request->input('areas'));;

        return redirect()->route('admin.rates.index')
        				 ->with('success','Areas update successfully');
	}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Rates::find($id)->delete();

        return redirect()->route('admin.rates.index')
        				 ->with('success','Location delete successfully');
    }


}
