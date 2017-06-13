<?php

namespace App\Http\Controllers;

use App\FundtypeModel;
use App\Http\Requests\JournalFormRequest;
use App\JournalModel;
use App\ResearchlevelModel;
use App\ResearchstatusModel;
use App\ProfileModel;
use App\UserresearchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{


    public function __construct ()
    {
        if (!$this->middleware('auth', [ 'except' => [ 'index', 'show' ] ])) {

            return redirect()->route('home');
        }
    }

    public function index ()
    {

//        return view('research.reserach-list');
    }

    public function create ()
    {
        $redirectTo = 'adasdasdads';

        $user = Auth::user();
        $funds = FundtypeModel::all();
        $researchStatus = ResearchstatusModel::all();
        $research_level = ResearchlevelModel::all();

        $data = array(

            'funds' => $funds,
            'researchStatus' => $researchStatus,
            'research_level' => $research_level,
            'user' => $user
        );

        return view('research.journal.journal-create', $data);

    }

    public function store (JournalFormRequest $request)
    {
        $journal = new JournalModel();

        if ($request->file('rj_file')) {

            $path = '/files/users/' . Auth::id() . '/' . 'journal/';
            // check directory exist
            if (!File::exists($path)) {
                // path does not exist
                File::makeDirectory($path, 0775, true);
            }
            //check file exist
//            if (File::exists($path. $request->rj_file)) {
//                File::delete($path. $request->rj_file);
//            }

            $journal_filename = time() . '.' . $request->rj_file->getClientOriginalExtension();
            $request->rj_file->move(public_path($path), $journal_filename);
            $journal->rj_file = $journal_filename;

        }

        $journal->rj_article_name = $request->rj_article_name;
        $journal->rj_name = $request->rj_name;
        $journal->rj_standard = $request->rj_standard;
        $journal->rj_owner = $request->rj_owner;
        $journal->rj_isbn = $request->rj_isbn;
        $journal->rj_accept_date = $request->rj_accept_date;
        $journal->rj_publish_date = $request->rj_publish_date;
        $journal->fund_id = $request->fund_id;
        $journal->rj_no = $request->rj_no;
        $journal->rj_page = $request->rj_page;
        $journal->rj_abstract = $request->rj_abstract;
        $journal->rj_meta_tag = $request->rj_meta_tag;
        $journal->rj_evaluate_article = $request->rj_evaluate_article;
        $journal->rj_publish_level = $request->rj_publish_level;
        $journal->rj_source_url = $request->rj_source_url;
        $journal->rj_volume = $request->rj_volume;

        try {
            DB::beginTransaction();

            $journal->save();

            $user_research = new UserresearchModel();
            $user_research->u_id = Auth::id();
            $user_research->rj_id = $journal->rj_id;
            $user_research->save();

            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();

            alert()->error('', 'เกิดข้อผิดพลาดในการบันทึก');
            return redirect()->route('profile.edit', Auth::id());
            /* Transaction failed. */
        }


        alert()->success('', 'ทำการเพิ่มข้อมูล Journal สำเร็จ');

        return redirect()->route('profile.edit', Auth::id());


    }


    public function show ($id)
    {

    }

    public function edit ($id)
    {

        $current_user = Auth::user();
        $journal = JournalModel::find($id);
        $funds = FundtypeModel::all();
        $researchStatus = ResearchstatusModel::all();
        $research_level = ResearchlevelModel::all();

        if ($current_user->u_id) {

            $user = ProfileModel::find(Auth::id());

            $data = array(
                'journal' => $journal,
                'funds' => $funds,
                'researchStatus' => $researchStatus,
                'research_level' => $research_level,
                'user' => $user
            );

        } else {


            return view('homepage');
        }

        return view('research.journal.journal-edit')->with($data);

    }

    public function update (Request $request, $id)
    {

        $journal = JournalModel::find($id);
        if ($request->file('rj_file')) {

            $path = '/files/users/' . Auth::id() . '/' . 'journal/';
            // check directory exist
            if (!File::exists($path)) {
                // path does not exist
                File::makeDirectory($path, 0775, true);
            }
            $journal_filename = time() . '.' . $request->rj_file->getClientOriginalExtension();
            $request->rj_file->move(public_path($path), $journal_filename);
            $journal->rj_file = $journal_filename;
        }

        $journal->rj_article_name = $request->rj_article_name;
        $journal->rj_name = $request->rj_name;
        $journal->rj_standard = $request->rj_standard;
        $journal->rj_owner = $request->rj_owner;
        $journal->rj_isbn = $request->rj_isbn;
        $journal->rj_accept_date = $request->rj_accept_date;
        $journal->rj_publish_date = $request->rj_publish_date;
        $journal->fund_id = $request->fund_id;
        $journal->rj_no = $request->rj_no;
        $journal->rj_page = $request->rj_page;
        $journal->rj_abstract = $request->rj_abstract;
        $journal->rj_meta_tag = $request->rj_meta_tag;
        $journal->rj_evaluate_article = $request->rj_evaluate_article;
        $journal->rj_publish_level = $request->rj_publish_level;
        $journal->rj_source_url = $request->rj_source_url;
        $journal->rj_volume = $request->rj_volume;

        try {
            DB::beginTransaction();

            $journal->save();

            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();

            alert()->error('', 'เกิดข้อผิดพลาดในการบันทึก');
            return redirect()->route('profile.edit', Auth::id());
            /* Transaction failed. */
        }

        alert()->success(' ', 'อัพเดตข้อมูลเรียบร้อย');

        return redirect()->route('profile.edit', $id);
    }

    public function uploadProfileImage (Request $request)
    {

    }

    public function destroy ($id)
    {

        $user_research = UserresearchModel::where('rj_id', $id)->get([ 'ur_id', 'u_id' ]);

        try {

            if ($user_research[ 0 ][ 'u_id' ] == Auth::id()) {
                DB::beginTransaction();

                UserresearchModel::destroy($user_research->toArray());

                $journal = JournalModel::withTrashed()->find($id);
                $journal->delete();
                DB::commit();
            } else {
                alert()->error('ไม่สามารถลบได้', 'ท่านไม่ใช่เจ้าของข้อมูล');
                return redirect()->route('profile.edit', Auth::id());
            }

            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();

            alert()->error('', 'เกิดข้อผิดพลาดในการลบข้อมูล');
            return redirect()->route('profile.edit', Auth::id());
            /* Transaction failed. */
        }

        alert()->success(' ', 'ลบวารสารเรียบร้อย');
        return back();

    }
}
