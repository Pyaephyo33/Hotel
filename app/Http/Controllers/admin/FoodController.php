<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Food;
use App\Repositories\Interfaces\FoodRepositoryInterface;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $foodRepository;
    public function __construct(FoodRepositoryInterface $foodRepository)
    {
        $this->foodRepository = $foodRepository;
        // $this->middleware(['permission:all-menu']); 
        $this->middleware(function($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            } 
            if (session('updated')) {
                Alert::success(session('updated'));
            }
            if (session('error')) {
                Alert::error(session('error'));
            }
            if (session('deleted')) {
                Alert::success(session('deleted'));
            }
            if (session('toggled')) {
                Alert::success(session('toggled'));
            }
            return $next($request);
        });
    } 
    

    public function index()
    {
        $foods = $this->foodRepository->allFoods();
        return view('admin.food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $food = new Food();
        return view('admin.food.form', compact('food'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:food,name',
            'price' => 'required',
        ]);

        // $this->foodRepository->storeFood($data);

        // return redirect('admin/foods')->with('success', 'Food Created Successfully!');

        // Alert::success('Success', 'Food Created Successfully');
        // return redirect('admin/foods');

        // session()->flash('success', 'Food Created Successfully');
        try {
            $this->foodRepository->storeFood($data);
            session()->flash('success', 'Food Created Successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred while creating food: ' . $e->getMessage());
        }
        return redirect('admin/foods');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $food = $this->foodRepository->findFood($id);
        return view('admin.food.form', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        $data = $request->validate([
            'name' => 'required|unique:food,name,' . $id,
            'price' => 'required',
        ]);

        // $this->foodRepository->updateFood($data, $id);
        // return redirect('admin/foods')->with('updated', 'Food Updated Successfully!');
        try {
            $this->foodRepository->updateFood($data, $id);
            session()->flash('updated', 'Food Updated Successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred while creating food: ' . $e->getMessage());
        }
        return redirect('admin/foods');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->foodRepository->destoryFood($id);
        // return back()->with('deleted', 'Food Successfully Deleted!');
        session()->flash('deleted', 'Food Successfully Deleted!');
        return back();
    }

    public function search(Request $request, FoodRepositoryInterface $foodRepository)
    {
        $searchData = '%' . $request->search . '%';
        $search = $request->search;
        $foods = $foodRepository->searchFood($searchData);
        return view('admin.food.index', compact('search', 'foods'));
    }

    public function change_status(Request $request)
    {
        $food = Food::findOrFail($request->id);

        $newStatus = !$food->status;
        $food->update(['status' => $newStatus]);
        session()->flash('toggled', 'Status Successfully Toggled!');
        return back();
    }
}
