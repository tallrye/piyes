<h3>Contact Me Now!</h3>
    @if(Session::has('success'))
    <div class="alert alert-success">
        Your message has just arrived. Thanks!
    </div>
    @endif
    <form action="{{ route('contact') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="form_id" value="{{ $pageForm->id }}">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>
        <div class="form-group">
            <input type="text" name="phone" class="form-control" placeholder="Your Phone">
        </div>
        <div class="form-group">
            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
        </div>
        <div class="form-group">
            <textarea name="body" id="body" class="form-control" cols="30" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary pull-right" type="submit">SEND</button>
        </div>
    </form>