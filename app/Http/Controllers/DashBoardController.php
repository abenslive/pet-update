<?php

namespace App\Http\Controllers;

use App\Models\PetChannel;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashBoardController extends Controller
{
    //dashboard
    public function dashBoard(){

        if(Auth::user()->role->slug == 'admin'){
            $sub_role = Role::where('slug','subscriber')->first();
            $aut_role = Role::where('slug','author')->first();
            $petChannel = PetChannel::count();
            $post = Post::count();
            $subscriber = User::where('role_id',$sub_role->id)->count();
            $author = User::where('role_id',$aut_role->id)->count();
            return view('admin.dashboard',compact(['petChannel','post','subscriber','author']));
        }

        elseif(Auth::user()->role->slug == 'subscriber'){

            $petChannel = PetChannel::count();
            $joined = Auth::user()->petChannels->count();

            return view('subscriber.dashboard',compact(['petChannel','joined']));
        } elseif(Auth::user()->role->slug == 'author'){
            return 'COMING SOON!!!';
        }
    }
    //profile
    public function profile($id){
        $user = User::find($id);

        return view('admin.profile',compact('user'));
    }
    //subscriber list
    public function subscribers(){
        $sub_role = Role::where('slug','subscriber')->first();

        $subscribers =  User::where('role_id',$sub_role->id)->paginate(100);

        return view('admin.subscribers',compact('subscribers'));
    }
    //list author
    public function authors(){
        $aut_role = Role::where('slug','author')->first();
        $authors =  User::where('role_id',$aut_role->id)->paginate(100);

        return view('admin.authors',compact('authors'));
    }
    //add new author
    public function newAuthor(Request $request){
        $request->validate([
            'username' => ['required','string','unique:users'], 'name' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',],
        ]);
        User::create([
            'username' => $request->username, 'name' => $request->name, 'email' => $request->email,
            'password' => Hash::make('12345678'), 'role_id' => 3
        ]);
        Session::flash('success','Author added');
        return redirect()->back();
    }

    //list pet channels
    public function petChannels(){

        if(Auth::user()->role->slug == 'admin'){
            $channels =  PetChannel::orderBy('name','asc')->paginate(50);
            return view('admin.pet-channel',compact('channels'));
        }

        elseif(Auth::user()->role->slug == 'subscriber'){
            $channels =  PetChannel::orderBy('name','asc')->paginate(50);
            return view('subscriber.pet-channel',compact('channels'));
        }
        else{ return 'COMING SOON';}


    }
    //add new channel
    public function newPetChannels(Request $request){
        $request->validate(['name' => ['required','string','unique:pet_channels'],]);
        PetChannel::create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        Session::flash('success','New Pet channel added');
        return redirect()->back();
    }

    public function subscribeToChannel(Request $request){
        $user = Auth::user();

        $channel = DB::table('pet_channel_user')->where(['pet_channel_id'=>$request->channel_id,'user_id'=>Auth::id()])->get();
        if ($channel->count() < 1) {
            $user->petChannels()->attach($request->channel_id,['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
            Session::flash('success', 'You just joined a channel');
            return redirect()->back();
        }else{
            $user->petChannels()->detach($request->channel_id);
            Session::flash('success', 'You have unsubscribed from a channel');
            return redirect()->back();
        }

    }
}
