<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\front\CommentRequest;
use App\Models\Comment;
use App\Events\AddLikeCommentEvent;
use App\Events\AddDisLikeCommentEvent;
use Auth;
use App\Models\OwnerComment;
use DB;
class CommentController extends Controller
{

    //هنا يفضل كتابة كونستركتور يلتزم بان الدوال  addComment addCommentReply deleteCommentيجب ان يكون مسجل دخول ليتمكن من استخدامهم


    public function addComment(CommentRequest $request, $question_id)
    {
        try{
            $comments_count=Comment::where('user_id',Auth::user()->id)->where('question_id',$question_id)->where('comment_id',null)->count();
            if($comments_count >= 20){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'بلغت الحد الاقصى  ',
                    'notifyMsg' => 'عذرا لقد بلغت الحد الاقصى من التعليقات على هذا السوال بالفعل لديك 20 اجابة قمت بأقتراحها'
                ]);
            }
            Comment::create([
                'comment' => $request->comment,
                'user_id' => Auth::user()->id,
                'question_id' => $question_id,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'إقتراح حل',
                'notifyMsg' => 'تم إضافة الحل الذي قمت بإقتراحه بنجاح'
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل إضافة الحل الذي قمت بإقتراحه .... الرجاء المحاولة لاحقا'
        
            ]);
        }
    }
    public function addCommentReply(CommentRequest $request, $comment_id){
        try{
            $comment_info =  Comment::find($comment_id);
            if(!$comment_info){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'غير موجود  ',
                    'notifyMsg' => 'الإجابة غير موجودة لتتمكن من التعليق عليها'
                ]);
            }
            $comments_count=Comment::where('user_id',Auth::user()->id)->where('comment_id',$comment_id)->count();
            if($comments_count >= 20){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'بلغت الحد الاقصى  ',
                    'notifyMsg' => 'عذرا لقد بلغت الحد الاقصى من التعليقات على هذة الاجابة بالفعل لديك 20 تعليق عليها'
                ]);
            }
            DB::beginTransaction();
            Comment::create([
                'comment' => $request->comment,
                'user_id' => Auth::user()->id,
                'comment_id' => $comment_id,
                'question_id' => $comment_info->question_id,
            ]);
            OwnerComment::create([
                'owner_id' => $comment_info->user_id,
                'question_id' => $comment_info->question_id,
            ]);
            DB::commit();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تعليق حول الحل',
                'notifyMsg' => 'تم ارسال التعليق بنجاح'
            ]);
        }catch (\Exception $ex){
            DB::rollback();
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل ارسال التعليق .... الرجاء المحاولة لاحقا'
            ]);
        }
    }
    
    public function AddLike($question_id)
    {
        try{
            $comment=Comment::find($question_id);
            if(!$comment){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذه الإجابة غير موجود'
                ]);
            }
            $status=event(new AddLikeCommentEvent($comment));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'الاعجاب بالإجابة',
                    'notifyMsg' => 'شكرا لك انت بالفعل قد اعجبت بالإجابة   '.$comment->title
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الاعجاب بالإجابة',
                'notifyMsg' => 'شكرا للإعجاب بالإجابة  '.$comment->title
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل الإعجاب بالإجابة    '. $comment->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    
    public function AddDisLike($question_id)
    {
        try{
            $comment=Comment::find($question_id);
            if(!$comment){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذه الإجابة غير موجود'
                ]);
            }
            $status=event(new AddDisLikeCommentEvent($comment));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'عدم الاعجاب بالإجابة',
                    'notifyMsg' => ' انت بالفعل لم تعجب بالإجابة   '.$comment->title
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'عدم الاعجاب بالإجابة',
                'notifyMsg' => 'تم عدم الاعجاب بالإجابة  '.$comment->title
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل دم الاعجاب بالإجابة    '. $comment->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function deleteComment($comment_id)
    {
        try{
            $comment=Comment::where('user_id',Auth::user()->id)->find($comment_id);
            if($comment == null){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'عذرا ... هذا التعليق غير موجود'
            
                ]);
            }
            $comment_replies = $comment -> comment_replies() -> count();
            if($comment_replies > 0){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'عذرا ... هذا التعليق لديه '.$comment_replies.' ردود من اشخاص اخرين بالتالي لا يمكنك حذفه'
            
                ]);
            }
            
            $comment ->delete();

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حذف التعليق ',
                'notifyMsg' => 'تم حذف التعليق بنجاح ',
                'item_id'=>$comment_id
            ]);
           
        
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حذف التعليق .... الرجاء المحاولة لاحقا'
        
            ]);
        }
    }


}
