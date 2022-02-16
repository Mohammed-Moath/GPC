<?php

namespace App\Http\Controllers;
use Alert;

use Illuminate\Http\Request;
use App\ProjectSupervisor;
use App\Proposal;
use App\Program;
use App\Proposal_Program;
use App\User;
use App\StatuProposal;
use App\SupervisorExpected;


class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try {
            $New_Proposal=Proposal::where('References',0)->where('Certified',0)->where('Selected',0)->get();
            $New= count($New_Proposal); //1
    
            $Certified_Proposal=Proposal::where('References',1)->where('Certified',1)->get();
            $Certified= count($Certified_Proposal);//2
    
            $Selected_Proposal= Proposal::where('References',1)->where('Certified',1)->where('Selected','>',0)->get();
            $Selected=count($Selected_Proposal);//3
    
            $All_Proposal= Proposal::orderBy('Selected','desc')->get();
            $All=count($All_Proposal);//4
            return view('GPCO.proposals.index',compact('New','Certified','Selected','All'));
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله Inedx.  "); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try{
            $Program = Program::all();
            return view('GPCO.proposals.create',compact('Program'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله create.  "); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        /*$Acad =Calendar_GPC()->AcademicYear;
        if( $request->AcademicYear != Calendar_GPC()->AcademicYear){
            session()->push('m','error');
            session()->push('m',"لقد قمت باختيار  :  $request->AcademicYear عام جامعي للمقترح ، ولكن العام الجامعي في إعدادات النظام  $Acad يرجي المراجعة واختيار العام الجامعي الصحيح!");  
            return redirect()->back();
        }

        $Seme = Calendar_GPC()->Semester;
        if( $request->Semester != Calendar_GPC()->Semester){
            session()->push('m','error');
            session()->push('m',"لقد قمت بأختيار : الفصل $request->Semester فصلاً دراسي للمقترح ، ولكن في إعدادات النظام الفصل الدراسي هو $Seme !. يرجى المراجعة واختيار الفصل الدراسي الصحيح.");  
            return redirect()->back();
        }*/
       
        $this->validate($request,
            [
                'AcademicYear'=>'required',
                'Semester'=>'required',
                'ProjectProposalTitle'=>'required|max:150|min:10',
                'descrdiption'=>'required|min:100',
                'scope'=>'required|min:50',
                'Outputs'=>'required|min:50',
                'ImportanceProposal'=>'required|min:50',
                'Program'=>'required',
                'Tools'=>'required|min:50',
                'NumberOfStudents'=>'required|numeric|digits_between:1,2|max:5|min:1',
                'Supervisor'=>'required',
            ],
            [   'required'=>'مطلوب اضافة بيانات هنا !.',
                'ProjectProposalTitle.max'=>'اقصي حروف يمكنك كتابته  150 حرف!',
                'ProjectProposalTitle.min'=>'اقل احرف يمكنك كتابته 10 حروف !',
                'descrdiption.min'=>'يرجي كتابة وصف لمقترح المشروع لا يقل عن 100 حرف !',
                'scope.min'=>'يرجي كتابة وصف لحدود المشروع لا يقل عن 50 حرف !',
                'Outputs.min'=>'يرجي كتابة وصف لمخرجات المشروع لا يقل عن 50 حرف !',
                'ImportanceProposal.min'=>'يرجي كتابة وصف لأهمية المشروع لا يقل عن 50 حرف !',
                'Tools.min'=>'يرجي كتابة وصف للادوات المتوقع استخدامها في المشروع لا يقل عن 50 حرف !',
                'NumberOfStudents.max'=>'أقصي عدد طلاب يمكنك اختياره هو 5 ',
                'NumberOfStudents.min'=>'أقل عدد طلاب يمكنك اختياره هو 1 ',
                'NumberOfStudents.digits_between'=>'يرجي كتابة رقم اقل من 10.',
            ]
        );
        try{
            
            $input =$request->all();
            
            $NewProposal = new Proposal;
            $NewProposal->AcademicYear = $request->AcademicYear;
            $NewProposal->Semester = $request->Semester;
            $NewProposal->ProjectProposalTitle = $request->ProjectProposalTitle;
            $NewProposal->descrdiption = $request->descrdiption;
            $NewProposal->scope = $request->scope;
            $NewProposal->Outputs = $request->Outputs;
            $NewProposal->ImportanceProposal = $request->ImportanceProposal;
            $NewProposal->Tools = $request->Tools;
            $NewProposal->NumberOfStudents = $request->NumberOfStudents;
            $NewProposal->PropertyRight = 5;
            $NewProposal->users_id =\Auth::user()->id;
            $NewProposal->References =1;
            $NewProposal->Certified =1;
            $NewProposal->save(); 
    
            foreach($input['Program'] as $Program){
                Proposal_Program::create(['proposal_id'=>$NewProposal->id,'program_id'=>$Program]);   
            }

            foreach($input['Supervisor'] as $Supervisor){
                SupervisorExpected::create(['proposals_id'=>$NewProposal->id,'FN_Supervisor'=>$Supervisor]);  
            }
            session()->push('m','success');
            session()->push('m',"تم أضافة المقترح بنجاح");  
            return redirect("Proposal/{$NewProposal->id}");
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله store.  "); 
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        try{
            $ShowProposal=Proposal::findOrfail($id);
            $Program = Proposal_Program::where('proposal_id',$id)->get();
            $p = array();
            foreach($Program as $pro){
                 $p [] = $pro->program_id;
            }
            $Programs = Program::all();
            $SP =  SupervisorExpected::where('proposals_id',$id)->get();
            return view('GPCO.proposals.show',compact('ShowProposal','p','Programs','SP'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله show.  "); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try{
            $Proposal=Proposal::findOrfail($id);
            if($Proposal->Selected > 0){
                session()->push('m','error');
                session()->push('m',"هذا المقترح قد تم أختياره ، لا يمكن التعديل عليه !");  
               
                return redirect()->back();
            }
            else{
                $Program = Program::all();
                $Proposal_Program = Proposal_Program::where('proposal_id',$id)->get();
                $ProgramID = array();
                foreach( $Proposal_Program  as $p){
                    $ProgramID[]= $p->program_id;
                }
                $SupervisorID = array();
                $Supervisor_Expected = SupervisorExpected::where('proposals_id',$id)->get();
                foreach( $Supervisor_Expected  as $s){
                    $SupervisorID[]= $s->FN_Supervisor;
                }
                return view('GPCO.proposals.edit',compact('Program','Proposal','ProgramID','SupervisorID'));
            } 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله edit.  "); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request,
            [
                'AcademicYear'=>'required',
                'Semester'=>'required',
                'ProjectProposalTitle'=>'required|max:150|min:10',
                'descrdiption'=>'required|min:100',
                'scope'=>'required|min:50',
                'Outputs'=>'required|min:50',
                'ImportanceProposal'=>'required|min:50',
                'Program'=>'required',
                'Tools'=>'required|min:50',
                'NumberOfStudents'=>'required|numeric|digits_between:1,2|max:5|min:1',
                'Supervisor'=>'required',
            ],
            [   'required'=>'مطلوب اضافة بيانات هنا !.',
                'ProjectProposalTitle.max'=>'اقصي حروف يمكنك كتابته  150 حرف!',
                'ProjectProposalTitle.min'=>'اقل احرف يمكنك كتابته 10 حروف !',
                'descrdiption.min'=>'يرجي كتابة وصف لمقترح المشروع لا يقل عن 100 حرف !',
                'scope.min'=>'يرجي كتابة وصف لحدود المشروع لا يقل عن 50 حرف !',
                'Outputs.min'=>'يرجي كتابة وصف لمخرجات المشروع لا يقل عن 50 حرف !',
                'ImportanceProposal.min'=>'يرجي كتابة وصف لأهمية المشروع لا يقل عن 50 حرف !',
                'Tools.min'=>'يرجي كتابة وصف للادوات المتوقع استخدامها في المشروع لا يقل عن 50 حرف !',
                'NumberOfStudents.max'=>'أقصي عدد طلاب يمكنك اختياره هو 5 ',
                'NumberOfStudents.min'=>'أقل عدد طلاب يمكنك اختياره هو 1 ',
                'NumberOfStudents.digits_between'=>'يرجي كتابة رقم اقل من 10.',
            ]
        );
        try{
            $input = $request->all();
            $input['References'] = '1';
            $Proposal = Proposal::findOrfail($id);// 
            $Proposal->update($input);
            
            Proposal_Program::where('proposal_id',$Proposal->id)->delete();
            foreach($input['Program'] as $Program){
                Proposal_Program::create(['proposal_id'=>$Proposal->id,'program_id'=>$Program]);
                
            }
            SupervisorExpected::where('proposals_id',$Proposal->id)->delete();
            foreach($input['Supervisor'] as $supervisor){
                SupervisorExpected::create(['proposals_id'=>$Proposal->id,'FN_Supervisor'=>$supervisor]);
                
            }
            
            session()->push('m','success');
            session()->push('m',"تم تعديل المقترح بنجاح");  
            return redirect("Proposal/{$Proposal->id}");   
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله update.  "); 
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $Proposal=Proposal::findOrfail($id);
            if($Proposal->Selected > 0){
                session()->push('m','error');
                session()->push('m',"هذا المقترح قد تم أختياره ، لا يمكنك حذفه !");  
                return redirect()->back();
            }
            else{
                $Proposal->delete();
                session()->push('m','success');
                session()->push('m',"تم حذف المقترح بنجاح");  
         
                return redirect("Proposal");
            } 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله destroy.  "); 
        }
       
    }
    public function Review($id){
        try{
            if($id == "1"){
                $Proposal=Proposal::where('References',0)->where('Certified',0)->where('Selected',0)->orderBy('created_at','desc')->paginate(5);
                $type=1;
                return view('GPCO.proposals.review',compact('Proposal','type'));
            }
            if($id == "2"){
                $Proposal=Proposal::where('References',1)->where('Certified',1)->paginate(10);
                $type=2;
                return view('GPCO.proposals.all',compact('Proposal','type'));
            }
            if($id == "3"){
                $Proposal= Proposal::where('References',1)->where('Certified',1)->where('Selected','>',0)->paginate(10);
                $type=3;
                return view('GPCO.proposals.all',compact('Proposal','type'));
            }
            if($id == "4"){
                $Proposal= Proposal::paginate(10);
                $type=4;
                return view('GPCO.proposals.all',compact('Proposal','type'));
            }
            return redirect()->back();
        }
        
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله Review.  "); 
        }
    }
    public function Approval(Request $request, $id){
        try{
            $Proposal =  Proposal::findOrfail($id); 
            if($Proposal->References == 0){
                session()->push('m','error');
                session()->push('m',"هذا المقترح لم تتم مراجعته، يراجي مراجعته اولا ومن ثم اعتماده.");  
                return redirect()->back();
            }
            else{
                $except ['References'] =1;
                $except ['Certified'] =1;
                $Proposal->update($except);
                session()->push('m','success');
                session()->push('m',"تم العملية بنجاح ، هذا المقترح معتمد الان.");  
                return redirect()->back();
            }           
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله except.  "); 
        }
    }
    public function CancellationOfAccreditation(Request $request, $id){ 
        try{
            $Proposal =  Proposal::findOrfail($id);
            if($Proposal->Selected > 0){
                session()->push('m','error');
                session()->push('m',"هذا المقترح قد تم أختياره ، لا يمكن الغاء اعتمادة!");  
                return redirect()->back();
            } 
            else{
                $except ['References'] =1;
                $except ['Certified'] =0;
                $Proposal->update($except);
                session()->push('m','success');
                session()->push('m',"تم العملية بنجاح ، هذا المقترح غير معتمد.");  
                return redirect()->back();
            }         
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بمقترحات مشاريع التخرج ، في الداله except.  "); 
        } 
    }


}
