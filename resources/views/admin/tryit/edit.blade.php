@extends('layouts.admin.dashboard')

@section('title','تعديل TryIt ')

@section('css')
<style>
   #code{direction: ltr;}
</style>
@endsection

@section('path')
     <li class="breadcrumb-item fw-bolder active " aria-current="page">تعديل TryIt {{$tryit->slug}}</li>

@endsection

@section('content')







<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('Tryit-dashboard.update',$tryit -> id)}}" method="POST" >
  @csrf
  @method('PUT')

  <input name="id" value="{{$tryit -> id}}" type="hidden">
  
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">تعديل TryIt</div>

    <div class="px-4">
 
        <div class="  mb-3  TIT">
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
            @error('slug')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
            
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="code" class="form-label fw-bolder text-dark">كود TryIt</label>
                <textarea id="code" type="textarea" name="code" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="10">{{$tryit -> code}}</textarea>
            </div>
            @error('code')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <hr class="bg-dark my-3" style="height: 5px;">
        @if($tryit -> code1 !== null)
        <p class="fs-5 fw-bold text-primary">- كود إضافي 1 </p>

        <div class="  mb-3 ">
            <div class="fw-bolder m-2 text-dark">نوع الكود 1</div>

            <input type="radio" value="css" class="btn-check" name="type1" id="css" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="css">css</label>

            <input type="radio" value="html" class="btn-check" name="type1" id="html" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="html">html</label>

            <input type="radio" value="javascript" class="btn-check" name="type1" id="javascript" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="javascript">javascript</label>

            <input type="radio" value="htmlmixed" class="btn-check" name="type1" id="htmlmixed" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="htmlmixed">htmlmixed</label>

            <input type="radio" value="php" class="btn-check" name="type1" id="php" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="php">php</label>

            <input type="radio" value="python" class="btn-check" name="type1" id="python" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="python">python</label>

            <input type="radio" value="sass" class="btn-check" name="type1" id="sass" autocomplete="off" >
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sass">sass</label>

            <input type="radio" value="sql" class="btn-check" name="type1" id="sql" autocomplete="off" checked="">
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sql">sql</label>
            @error('slug1')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
            
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="code1" class="form-label fw-bolder text-dark">كود TryIt 1</label>
                <textarea id="code1" type="textarea" name="code1" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="10">{{$tryit -> code1}}</textarea>
            </div>
            @error('code1')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        @endif
        @if($tryit -> code2 !== null)
        <p class="fs-5 fw-bold text-primary">- كود إضافي 2 </p>

        <div class="  mb-3 ">
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

            <input type="radio" value="sql" class="btn-check" name="type2" id="sql2" autocomplete="off" checked="">
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="sql2">sql</label>
            @error('slug2')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
            
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="code2" class="form-label fw-bolder text-dark">كود TryIt 2</label>
                <textarea id="code2" type="textarea" name="code2" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="10">{{$tryit -> code2}}</textarea>
            </div>
            @error('code2')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        @endif
        <div class="form-check form-switch col-md-12 px-3 my-4 text-center">
            <button type="submit"  type="button" class="btn rounded-3 bg-gradient-primary mx-1">
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
let radioList = [[...document.querySelectorAll("input[name=type]")],
                [...document.querySelectorAll("input[name=type1]")],
                [...document.querySelectorAll("input[name=type2]")]];
    let old_type = ["{{$tryit -> type}}","{{$tryit -> type1}}","{{$tryit -> type2}}"];

    radioList.forEach((one_arr,index) => {
        
        for (let i = 0; one_arr[i] ; i++) {
            if(one_arr[i].getAttribute("value") === old_type[index]){
    
                one_arr[i].checked = true;
            }
            
        }
    });
       
</script>
@endsection

