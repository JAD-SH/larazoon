<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>
<link href="{{Site()->site_logo}}" rel="icon"><!--عدله في المستقبل اذا غير اسم الصورة او الامتداد الى icon -->

<meta name = "twitter:card" content = "summary_large_image"></meta><!--لا تتغير -->
<meta name = "twitter:site" content = "{{Site()->site_name}}"></meta><!-- يمكن لازم نحط @ قبل الاسم ولازم يكون بالاساس هذا الاسم يشير الي اسم الصفهة على تويتر يمكننننننننن -->
<meta name = "twitter:creator" content = "{{Site()->site_name}}"></meta><!-- يمكن لازم نحط @ قبل الاسم ولازم يكون بالاساس هذا الاسم يشير الي اسم الصفهة على تويتر يمكننننننننن -->
<meta name="description" content="@yield('description')">
<meta property = "og:type" content = "website" /><!--لا تتغير -->
<meta property = "og:site_name" content = "{{Site()->site_name}}" /><!--اسم الموقع -->
<meta property = "og:locale" content = "ar_SA" /><!--لا تتغير -->

<meta property = "og:title" content = "@yield('title')" /><!--عنوان الصفحة title -->
<meta property = "og:description" content = "@yield('description')" /><!--الوصف -->
<meta property = "og:url" content = "@yield('og:url')" />
<meta property = "og:image" content = "@yield('og:image')" /><!--رابط صورة المقال اذا كنا نعرض او درس الخ ... واذا لا يوجد شيئ نضع رابط صورة الموقع الرئيسية -->
<meta property = "og:image:url" content = "@yield('og:image:url')" /><!--لا تتغير -->

@yield('meta_tags')
<meta name="google" content="nositelinkssearchbox">
 
<link href="{{asset('public/assets/bootstrap/bootstrapRTL.css')}}" rel="stylesheet" />
 


<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('public/assets/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/fontawesome/css/all.min.css')}}">



<!-- custome style -->
<link href="{{asset('public/assets/css/root.css')}}" rel="stylesheet" />
<link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet" />
<!-- custome style -->

<script>
  let title_tag = document.querySelector('title');
  if(title_tag.textContent == ''){
    title_tag.textContent = '{{Site()->site_name}}';
  }
  let meta_title = document.querySelector('meta[property="og:title"][content=""]');
  if(meta_title){
    meta_title.setAttribute('content','{{Site()->site_name}}');
  }
  let meta_og_description = document.querySelector('meta[property="og:description"][content=""]');
  if(meta_og_description){
    meta_og_description.setAttribute('content','{{Site()->site_description}}');
  }
  let meta_description = document.querySelector('meta[name="description"][content=""]');
  if(meta_description){
    meta_description.setAttribute('content','{{Site()->site_description}}');
  }
  let meta_url = document.querySelector('meta[property="og:url"][content=""]');
  if(meta_url){
    meta_url.setAttribute('content','هنا من جدول الموقع الذل لم تنشأه بعد');
  }
  let meta_image = document.querySelector('meta[property="og:image"][content=""]');
  if(meta_image){
    meta_image.setAttribute('content','{{Site()->site_photo}}');
  }
  let meta_image_url = document.querySelector('meta[property="og:image:url"][content=""]');
  if(meta_image_url){
    meta_image_url.setAttribute('content','{{Site()->site_photo}}');
  }
  
</script>

