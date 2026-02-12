<form action=""
      class="w-100"
      method="post"
      id="order-compose-form"
      data-user-type="{{ auth()->user()->type }}">

    <div class="row ticket-compose" id="order-compose">

        <!--options panel-->
        @include('pages.orders.components.create.options')

        <!--compose panel-->
        <div class="col-sm-12 col-lg-9">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">

                            <!--ORDER NUMBER-->
                            <div class="form-group">
                                <input class="form-control"
                                       name="order_number"
                                       id="order_number"
                                       placeholder="{{ cleanLang(__('lang.order')) }}:">
                            </div>

                            <!--CLIENT NAME-->
                            <div class="form-group">
                                <input class="form-control"
                                       name="client_name"
                                       id="client_name"
                                       placeholder="{{ cleanLang(__('lang.client')) }}:">
                            </div>

                            <!--NOTES / DESCRIPTION-->
                            <div class="form-group">
                                <textarea class="tinymce-textarea"
                                          name="description"
                                          id="description"
                                          rows="15"></textarea>
                            </div>

                            <!--fileupload-->
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="dropzone dz-clickable"
                                         id="fileupload_order">
                                        <div class="dz-default dz-message">
                                            <i class="icon-Upload-toCloud"></i>
                                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--tags-->
                            @if(auth()->user()->is_team)
                            <div class="form-group row">
                                <label class="col-12 text-left control-label col-form-label">
                                    {{ cleanLang(__('lang.tags')) }}
                                </label>

                                <div class="col-12">
                                    <select name="tags"
                                            id="tags"
                                            class="form-control form-control-sm select2-multiple {{ runtimeAllowUserTags() }} select2-hidden-accessible"
                                            multiple="multiple">

                                        @if(isset($page['section']) && $page['section'] == 'edit')
                                            @foreach($order->tags ?? [] as $tag)
                                                @php $selected_tags[] = $tag->tag_title ; @endphp
                                            @endforeach
                                        @endif

                                        @foreach($tags ?? [] as $tag)
                                        <option value="{{ $tag->tag_title }}"
                                            {{ runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags ?? []) }}>
                                            {{ $tag->tag_title }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            @endif

                            <!--submit-->
                            <div class="text-lg-right">
                                <button type="submit"
                                        class="btn btn-rounded-x btn-danger m-t-20"
                                        id="order-compose-form-button"
                                        data-url="{{ url('/orders') }}"
                                        data-type="form"
                                        data-ajax-type="post"
                                        data-loading-overlay-target="wrapper-orders"
                                        data-loading-overlay-classname="overlay"
                                        data-form-id="order-compose">
                                    {{ cleanLang(__('lang.submit_order')) }}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
