@extends('layouts.admin.dashboard')

@section('title','أنشاء tryit جديد')

@section('css')
<style>
   #code{direction: ltr;}
    
</style>
@endsection


@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">أنشاء tryit جديد</li>
@endsection

@section('content')

   


<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('Tryit-dashboard.store')}}" method="POST">
  @csrf
    @isset($tryitable_type, $tryitable_id)
        <input name="tryitable_type" value="{{$tryitable_type}}" type="hidden">
        <input name="tryitable_id" value="{{$tryitable_id}}" type="hidden">
    @endisset

  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">أنشاء tryit جديد</div>

    <div class="px-4">
 
          <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"  placeholder="مثال : how-much-programers-salery" >
            </div>
            <div id="slug_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>
 
        

        <div class="  mb-3  ">
            <div class="fw-bolder m-2 text-dark">نوع الكود</div>

            <input type="radio" value="css" class="btn-check" name="type" id="css" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="css">css</label>

            <input type="radio" value="html" class="btn-check" name="type" id="html" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="html">html</label>

            <input type="radio" value="javascript" class="btn-check" name="type" id="javascript" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="javascript">javascript</label>

            <input type="radio" value="htmlmixed" class="btn-check" name="type" id="htmlmixed" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="htmlmixed">htmlmixed</label>

            <input type="radio" value="php" class="btn-check" name="type" id="php" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="php">php</label>

            <input type="radio" value="python" class="btn-check" name="type" id="python" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="python">python</label>

            <input type="radio" value="sass" class="btn-check" name="type" id="sass" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sass">sass</label>

            <input type="radio" value="sql" class="btn-check" name="type" id="sql" autocomplete="off" checked="">
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sql">sql</label>

            
            <div id="type_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="code" class="form-label fw-bolder text-dark">كود tryit</label>
                <textarea id="code" type="textarea" name="code" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="10"></textarea>
            </div>
            <div id="code_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
        </div>

        <hr class="bg-dark my-3" style="height: 5px;">

        <p class="fs-5 fw-bold text-primary">- كود إضافي 1 (أختياري)</p>
        <div class="  mb-3  ">
            <div class="fw-bolder m-2 text-dark">نوع الكود 1</div>

            <input type="radio" value="css" class="btn-check" name="type1" id="css1" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="css1">css</label>

            <input type="radio" value="html" class="btn-check" name="type1" id="html1" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="html1">html</label>

            <input type="radio" value="javascript" class="btn-check" name="type1" id="javascript1" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="javascript1">javascript</label>

            <input type="radio" value="htmlmixed" class="btn-check" name="type1" id="htmlmixed1" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="htmlmixed1">htmlmixed</label>

            <input type="radio" value="php" class="btn-check" name="type1" id="php1" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="php1">php</label>

            <input type="radio" value="python" class="btn-check" name="type1" id="python1" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="python1">python</label>

            <input type="radio" value="sass" class="btn-check" name="type1" id="sass1" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sass1">sass</label>

            <input type="radio" value="sql" class="btn-check" name="type1" id="sql1" autocomplete="off">
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sql1">sql</label>

            
            <div id="type1_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
        </div>
        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="code1" class="form-label fw-bolder text-dark">كود tryit 1</label>
                <textarea id="code1" type="textarea" name="code1" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="10"></textarea>
            </div>
            <div id="code1_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
        </div>

        <p class="fs-5 fw-bold text-primary">- كود إضافي 2 (أختياري)</p>
        <div class="  mb-3  ">
            <div class="fw-bolder m-2 text-dark">نوع الكود 2</div>

            <input type="radio" value="css" class="btn-check" name="type2" id="css2" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="css2">css</label>

            <input type="radio" value="html" class="btn-check" name="type2" id="html2" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="html2">html</label>

            <input type="radio" value="javascript" class="btn-check" name="type2" id="javascript2" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="javascript2">javascript</label>

            <input type="radio" value="htmlmixed" class="btn-check" name="type2" id="htmlmixed2" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="htmlmixed2">htmlmixed</label>

            <input type="radio" value="php" class="btn-check" name="type2" id="php2" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="php2">php</label>

            <input type="radio" value="python" class="btn-check" name="type2" id="python2" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="python2">python</label>

            <input type="radio" value="sass" class="btn-check" name="type2" id="sass2" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sass2">sass</label>

            <input type="radio" value="sql" class="btn-check" name="type2" id="sql2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sql2">sql</label>

            
            <div id="type2_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
        </div>
        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="code2" class="form-label fw-bolder text-dark">كود tryit 2</label>
                <textarea id="code2" type="textarea" name="code2" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="10"></textarea>
            </div>
            <div id="code2_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
        </div>
        
        <div class="form-check form-switch col-md-12 px-3 my-4 text-center">
            <button type="button" class="btn rounded-3 bg-gradient-primary mx-1 ajax-submit">
                حفظ
            </button>
            <button type="button" class="btn rounded-3 bg-gradient-secondary mr-1" onclick="window.close();">
                تراجع
            </button>
            
        </div>


    </div>
  </form>
</div>
 
@endsection
@section('script')
<script>

ajax_function();
</script>
@endsection

