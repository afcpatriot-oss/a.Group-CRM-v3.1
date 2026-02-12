<div class="modal-body">

    <form action="<?php echo e(url('/orders')); ?>"
          method="POST"
          class="js-ajax-ux-request reset-target-modal-form"
          data-ajax-type="POST"
          data-type="form"
          data-form-id="orders-add-form">

        <?php echo csrf_field(); ?>

        

        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 col-form-label">
                Фамилия
            </label>
            <div class="col-sm-12 col-lg-9">
                <input type="text"
                       name="last_name"
                       class="form-control form-control-sm">
            </div>
        </div>

<div class="form-group row">
            <label class="col-sm-12 col-lg-3 col-form-label required">
                Имя *
            </label>
            <div class="col-sm-12 col-lg-9">
                <input type="text"
                       name="first_name"
                       class="form-control form-control-sm"
                       required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 col-form-label">
                Отчество
            </label>
            <div class="col-sm-12 col-lg-9">
                <input type="text"
                       name="middle_name"
                       class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 col-form-label required">
                Телефон *
            </label>
            <div class="col-sm-12 col-lg-9">
                <input type="text"
                       name="phone"
                       class="form-control form-control-sm"
                       required>
            </div>
        </div>

    </form>

</div>


<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/orders/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>