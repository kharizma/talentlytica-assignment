<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

use App\Models\User;
use App\Models\Assessment;

class ParticipantController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            $data = Assessment::join('users','assessments.user_id','users.id')
                ->select('assessments.*','users.name','users.email')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn mr-1 mb-1" type="button" data-bs-toggle="dropdown"><i class="fa fa-2x fa-ellipsis-v"></i></button>
                                <div class="dropdown-menu bg-secondary">
                                    <div class="d-grid">
                                        <a href="'.route('home.participant.show',$item->user_id).'" class="btn btn-default btn-sm">Lihat Laporan</a>
                                        <a href="'.route('home.participant.edit',$item->user_id).'" class="btn btn-default btn-sm">Ubah</a>
                                        <button type="button" class="btn btn-default btn-sm" onclick="button_delete(\''.$item->user_id.'\')">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('home.participant.index');
    }

    public function create()
    {
        return view('home.participant.create');
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'  => 'required|string|max:255',
                'email' => 'required|email',
                'x'     => 'required|numeric|min:0',
                'y'     => 'required|numeric|min:0',
                'z'     => 'required|numeric|min:0',
                'w'     => 'required|numeric|min:0',
            ]);

            if($validator->fails()){
                $errors = $validator->errors();

                return redirect()->route('home.participant.create')->withErrors($errors)->withInput();
            }

            DB::beginTransaction();

            $id = 'PAR-'.strtoupper(Str::random(10));

            User::create([
                'id'            => $id,
                'role'          => 'participant',
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => bcrypt('password123!#'),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            Assessment::create([
                'id'                        => Str::uuid(),
                'user_id'                   => $id,
                'x'                         => $request->x,
                'y'                         => $request->y,
                'z'                         => $request->z,
                'w'                         => $request->w,
                'intelligence_aspect'       => round((($request->x*40/100)+($request->y*60/100))/2),
                'numerical_ability_aspect'  => round((($request->z*30/100)+($request->w*70/100))/2),
                'created_at'                => now(),
                'updated_at'                => now()
            ]);

            DB::commit();

            return redirect()->route('home.participant.index')->with('success','Sukses menambahkan peserta');
        }catch(Exception $e){
            Log::debug('Something Wrong at Create Participant');
            Log::debug($e);
            DB::rollBack();

            return redirect()->route('home.participant.create')->with('error','Sistem sedang bermasalah, Mohon coba kembali beberapa saat')->withInput();
        }
    }

    public function show($id)
    {
        $participant = User::where('id',$id)->first();
        $assessment = Assessment::where('user_id',$participant->id)->first();

        return view('home.participant.show',compact('participant','assessment'));
    }

    public function edit($id)
    {
        $participant    = User::findOrFail($id);
        $assessment     = Assessment::where('user_id',$id)->first();

        return view('home.participant.edit',compact('participant','assessment'));
    }

    public function update($id,Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'  => 'required|string|max:255',
                'email' => 'required|email',
                'x'     => 'required|numeric|min:0',
                'y'     => 'required|numeric|min:0',
                'z'     => 'required|numeric|min:0',
                'w'     => 'required|numeric|min:0',
            ]);

            if($validator->fails()){
                $errors = $validator->errors();

                return redirect()->route('home.participant.create')->withErrors($errors)->withInput();
            }

            DB::beginTransaction();

            User::where('id',$id)->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'updated_at'    => now()
            ]);

            Assessment::where('user_id',$id)->update([
                'x'                         => $request->x,
                'y'                         => $request->y,
                'z'                         => $request->z,
                'w'                         => $request->w,
                'intelligence_aspect'       => round((($request->x*40/100)+($request->y*60/100))/2),
                'numerical_ability_aspect'  => round((($request->z*30/100)+($request->w*70/100))/2),
                'updated_at'                => now()
            ]);

            DB::commit();

            return redirect()->route('home.participant.index')->with('success','Sukses mengubah peserta');
        }catch(Exception $e){
            Log::debug('Something Wrong at Create Participant');
            Log::debug($e);
            DB::rollBack();

            return redirect()->route('home.participant.edit',$id)->with('error','Sistem sedang bermasalah, Mohon coba kembali beberapa saat')->withInput();
        }
    }

    public function destroy($id)
    {
        try{
            $validated = User::where('id',$id)
                ->select('id')
                ->first();

            if(isset($validated->id)){
                Assessment::where('user_id',$validated->id)->delete();
                User::where('id',$id)->delete();

                return response()->json(200);
            }else{
                return response()->json(400);
            }        
        }catch(Exception $e){
            Log::debug($e);
            return redirect()->route('home.participant.index')->with('success','Gagal menghapus peserta');
        }
    }
}
