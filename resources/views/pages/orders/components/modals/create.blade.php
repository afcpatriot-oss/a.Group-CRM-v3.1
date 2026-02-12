<form id="commonModalForm"
      class="js-ajax-ux-request"
      data-url="{{ url('orders') }}"
      method="POST">

    @csrf

    <div class="form-group">
        <label>Order Title</label>
        <input type="text" name="order_title" class="form-control" required>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </div>

</form>
