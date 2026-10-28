@extends('admin.layouts.app')
@section('title', 'Website Setting')
@section('subtitle', "Website Identities, Logo, Contact and Profile Configuration")

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
        @csrf

        <ul class="nav nav-tabs mb-3" id="defaultTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-dark" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                    <i class="bi bi-house-door me-1"></i> General Settings
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false" tabindex="-1">
                    <i class="bi bi-telephone me-1"></i> Contact and Location
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages-tab-pane"
                    type="button" role="tab" aria-controls="messages-tab-pane" aria-selected="false" tabindex="-1">
                    <i class="bi bi-link me-1"></i> Social Media
                </button>
            </li>
        </ul>

        <div class="tab-content text-muted-green small" id="defaultTabsContent">
            <div class="tab-pane fade active show mt-4" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">

                <h5 class="fw-bold text-main mb-3">General Settings</h5>

                <div class="mb-3">
                  <label for="" class="form-label">Company Name / Website</label>
                  <input type="text" class="form-control" name="site_name" value="{{ old('site_name', $setting['site_name']->value) }}">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Website Tagline</label>
                  <input type="text" class="form-control" name="site_tagline" value="{{ old('site_tagline', $setting['site_tagline']->value) }}">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Website Short Description</label>
                  <textarea name="site_description" id="" cols="30" rows="10" class="form-control" value="{{ old('site_description', $setting['site_description']->value) }}"></textarea>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Website Logo</label>
                  <input type="file" name="site_logo" value="{{ old('site_logo', $setting['site_logo']->value) }}">
                </div>

            </div>
            <div class="tab-pane fade mt-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

              <h5 class="fw-bold text-main mb-3">Contact and Location</h5>  
              
              <div class="mb-3">
                <label for="" class="form-label">Telephone Number</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', $setting['phone']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Upload Email</label>
                <input type="text" class="form-control" name="email_upload" value="{{ old('email_upload', $setting['email_upload']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Order Email</label>
                <input type="text" class="form-control" name="email_order" value="{{ old('email_order', $setting['email_order']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Address</label>
                <textarea name="address" id="" cols="30" rows="10" class="form-control" value="{{ old('address', $setting['address']->value) }}"></textarea>              
              </div>
              
            </div>
            <div class="tab-pane fade mt-4" id="messages-tab-pane" role="tabpanel" aria-labelledby="messages-tab" tabindex="0">

              <h5 class="fw-bold text-main mb-3">Social Media</h5>  

              <div class="mb-3">
                <label for="" class="form-label">Url Shopee</label>
                <input type="text" class="form-control" name="url_shopee" value="{{ old('url_shopee', $setting['url_shopee']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Url Facebook</label>
                <input type="text" class="form-control" name="url_facebook" value="{{ old('url_facebook', $setting['url_facebook']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Url Instagram</label>
                <input type="text" class="form-control" name="url_instagram" value="{{ old('url_instagram', $setting['url_instagram']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Url Youtube</label>
                <input type="text" class="form-control" name="url_youtube" value="{{ old('url_youtube', $setting['url_youtube']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Url Tiktok</label>
                <input type="text" class="form-control" name="url_tiktok" value="{{ old('url_tiktok', $setting['url_tiktok']->value) }}">
              </div>

            </div>
        </div>
        <div class="card-footer">
          <button class="btn-custom btn-custom-primary" type="submit">Save</button>
        </div>
    </form>
@endsection

