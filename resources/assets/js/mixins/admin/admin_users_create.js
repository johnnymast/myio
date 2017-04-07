export default {
    data: function(){
        return {
            admin_user_create_form: {
                show_opt_actv_mail: false,
            }
        }
    },
    methods: {
        activateChanged: function () {
            this.admin_user_create_form.show_opt_actv_mail = (event.target.value == false);
        }
    }
}