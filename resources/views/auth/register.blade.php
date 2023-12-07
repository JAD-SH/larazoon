
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
 <!-- head -->
 @section('title','التسجيل في الموقع ')
 @include('layouts.front.head')

 
<style>
  .glossy{
      width:200%;
      height: 30px;
      position: absolute;
      filter: blur(7px);
      background-color: #ffffffa1;
      z-index: 2;
      transform: rotateZ(45deg);
      top:100%;
      left:-110%;
      animation-name: AGlossy;
      animation-duration: 2s;
      animation-delay: 0s;
      animation-iteration-count: infinite;
  }
  @keyframes AGlossy {
      from {top:100%;left:-110%;}
      to {top:-110%;left:100%;}
  }
  .nav-pills .nav-link.active{
    background-color:#dd2466 !important;
    color:white !important;
    border-radius: 8px !important;
  }
</style>
<!-- head -->
</head>

<body class="@isset($_COOKIE['DarkMode']) dark @endisset">
  <main class="main-content">
    <div class="page-header align-items-center min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-5">
          <div class="col-12 mx-auto card border-0 justify-content-center rounded-5 shadow-sm pb-4">
              <div class=" mt-n4 mx-3">
                <div class="bg-gradient-primary shadow-primary rounded-5 py-3 pe-1 text-center">
                  <span class="text-white fw-bolder text-center mt-2 mb-0 p-2 fs-4">التسجيل في الموقع</span>
                </div>
              </div>

                
              <div class="card-body">
                <form role="form" action="{{ route('register') }}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class=" row ">
    
                  <div class="col-lg-4 col-md-6 my-3 ">
                    <label for="name" class=" fw-bolder fs-6">الاسم</label>
                    <div class="input-group input-group-outline my-3 ">
                      <input id="name" type="text" name="name" class="form-control rounded-3">
                    </div>
                    @error('name')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-md-6 my-3">
                    <label for="email" class=" fw-bolder fs-6">البريد الالكتروني</label>
                    <div class="input-group input-group-outline my-3">
                      <input id="email" type="email" name="email" class="form-control rounded-3">
                    </div>
                    @error('email')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>

                  <div class="col-lg-4 col-md-6 my-3">
                    <label for="password" class=" fw-bolder fs-6">كلمة المرور</label>
                    <div class="input-group input-group-outline my-3">
                      <input id="password" type="password" name="password" class="form-control rounded-3">
                    </div>
                    @error('password')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>

                  <div class="col-lg-4 col-md-6 my-3">
                    <label for="password_confirmation" class=" fw-bolder fs-6">تأكيد كلمة المرور</label>
                    <div class="input-group input-group-outline my-3">
                      <input id="password_confirmation" type="password" class="form-control rounded-3" name="password_confirmation">
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-6 my-3">
                    <label for="photo" class=" fw-bolder fs-6">الصورة(اختياري) (نسب الابعاد 1/1)</label>
                    <div class="input-group input-group-outline my-3">
                      <input id="photo" type="file" name="photo" class="form-control rounded-3" aria-label="مثال على إدخال ملف كبير">
                    </div>
                    @error('photo')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>

                  <div class="col-lg-4 col-md-6 my-3">
                    <label for="birth_date" class=" fw-bolder fs-6">تاريخ ميلادك (اختياري)</label>
                    <div class="input-group input-group-static my-3">
                      <input id="birth_date" type="date" name="birth_date" class="form-control rounded-3">
                    </div>
                    @error('birth_date')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>
                  
                  <div class="col-lg-4 col-md-6 my-3">

                    <label for="male" class=" fw-bolder fs-6">الجنس</label>

                    <div class="nav-wrapper position-relative start-0 my-3">
                        <ul class="nav nav-pills nav-fill p-1 gender bg-light rounded-3" role="tablist">
                            <li type="button" class="nav-item fw-bolder" onclick="checkFunction('gender')">
                                <div class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" id="free" role="tab" aria-controls="dashboard" aria-selected="true"  >
                                ذكر <i class="fa-solid fa-person p-1 bg-gradient-primary text-white fs-5 rounded-3"></i>
                                <input id="male"  type="checkbox"  value="0" class="invisible " name="gender" checked>
                                </div>
                            </li>
                            <li type="button" class="nav-item fw-bolder" onclick="checkFunction('gender')">
                                <div class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" id="paid" role="tab" aria-controls="profile" aria-selected="false" >
                                انثى <i class="fa-solid fa-person-dress p-1 bg-gradient-primary text-white fs-5 rounded-3"></i>
                                <input id="female"  type="checkbox" value="1" class="invisible " name="gender">
                                </div>
                            </li>
                        </ul>
                    </div>
                    @error('gender')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>
                    
                   
                  <div class="col-lg-4 col-md-6 my-3">
                  <label for="frontend" class=" fw-bolder fs-6"> مهتم ب </label>

                    <div class="nav-wrapper position-relative start-0 my-3">
                      <ul class="nav nav-pills nav-fill flex-column p-1 interest  bg-light rounded-3" role="tablist">
                        <li  type="button" class="nav-item fw-bolder"  onclick="checkFunction('interest')">
                          <div class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" role="tab" aria-controls="preview" aria-selected="true">
                            Front End
                            <input id="frontend"  type="checkbox"  value="Front End" class="invisible" name="interest" checked>
                          </div>
                        </li>
                        <li  type="button" class="nav-item fw-bolder"  onclick="checkFunction('interest')">
                          <div class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" role="tab" aria-controls="code" aria-selected="false">
                            Back End
                            <input id="backend"  type="checkbox"  value="Back End" class="invisible" name="interest">
                          </div>
                        </li>
                        <li  type="button" class="nav-item fw-bolder"  onclick="checkFunction('interest')">
                          <div class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" role="tab" aria-controls="code" aria-selected="false">
                            Full Stuck
                            <input id="fullstuck"  type="checkbox"  value="Full Stuck" class="invisible" name="interest">
                          </div>
                        </li>
                        <li  type="button" class="nav-item fw-bolder"  onclick="checkFunction('interest')">
                          <div class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" role="tab" aria-controls="code" aria-selected="false">
                            Programming
                            <input id="programming"  type="checkbox"  value="programming" class="invisible" name="interest">
                          </div>
                        </li>
                      </ul>
                    </div>
                    @error('interest')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>
                  <div class="col-12 my-3">
                    <div>
                        <label for="description" class=" fw-bolder fs-6">وصف حولك (اختياري)</label>
                        <textarea id="description" type="textarea" name="description" class="fw-bolder form-control border p-2 my-3 rounded-3" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    @error('description')
                      <p class='w-100 bg-danger alert text-light m-0 p-2 my-1'>
                          <strong class="fw-bolder ">{{ $message }}</strong>
                      </p>
                    @enderror
                  </div>
                </div>
                  
                  <div class="text-center">
                      <button type="submit" class="btn rounded-3 bg-gradient-primary m-3 w-85  fs-6 position-relative overflow-hidden">
                        تسجيل
                        <div class=" glossy"></div>
                      </button>
                  </div>
                  
                </form>
              </div>
          </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->

  @include('layouts.front.js')

  <!--   Core JS Files   -->
  
<script>

  function checkFunction(itemclass) {
    let items = document.querySelectorAll(`.${itemclass} li div`);
    let arrayItems=[...items];

    arrayItems.forEach(item => {
      item.querySelector("input[type='checkbox']").checked = false;
      if(item.classList.contains("active")){
        item.querySelector("input[type='checkbox']").checked = true;
      }

    });
  }
</script>
</body>

</html>