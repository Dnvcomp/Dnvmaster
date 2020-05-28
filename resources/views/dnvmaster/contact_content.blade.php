@if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="section-block">
    <div class="container">
        <div class="section-heading center-holder">
            <h2>Напишите нам</h2>
        </div>
        <div class="row mt-70">
            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                <form id="contact-form-contact-us" method="post" class="primary-form" action="{{ route('contacts') }}" enctype="multipart/form-data">
                    <div class="col-xs-12">
                        <input type="text" name="name" id="name-contact-us" placeholder="Иван">
                    </div>
                    <div class="col-xs-12">
                        <input type="text" name="email" id="email-contact-us" placeholder="dnvcomp@podusham.by">
                    </div>
                    <div class="col-xs-12">
                        <textarea name="text" id="message-contact-us" placeholder="Сообщение"></textarea>
                    </div>
                    <div class="center-holder">
                        {{ csrf_field() }}
                        <button type="submit" class="button button-primary mt-30">{{ trans('ru.send_message') }}</button>
                    </div>
                </form>
                <script type="text/javascript">
                    var messages_form_126 = {
                        name: "Пожалуйста, введите свое имя",
                        email: "Пожалуйста, введите свой действительный е-майл адрес",
                        message: "Пожалуйста, вставьте или напишите своё сообщение."
                    };
                </script>
            </div>
        </div>
    </div>
</div>