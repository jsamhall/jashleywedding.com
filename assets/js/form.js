(function ($) {
    getFormData = function () {
        return $("form input,textarea").map(function () {
            return this.value.length > 0
                ? {field: this.name, value: this.value}
                : null;
        }).get();
    };

    var submitted = false;
    $('#submit_rsvp').on('click', function (event) {
        if(submitted == true){
            alert("Form has already been submitted!");
            return false; // prevent double submit
        }

        var btn = $(this);
        if ((results = getFormData()).length !== 3) {
            alert("Please complete all fields!");
            return false;
        }

        var data = {};
        $(results).each(function (idx, obj) {
            data[obj.field] = obj.value;
        });

        $.ajax({
            url: 'remote.php',
            data: data,
            dataType: 'json',
            success: function (response) {
                if(! response.success){
                    alert("There was an issue submitting the form: " + response.message);
                    return false;
                }

                btn.text("Sent! Thank you!");
                submitted = true;
            }
        });

        // prevent the <a> click from refreshing the page
        event.preventDefault();
        return false;
    });
})(jQuery);