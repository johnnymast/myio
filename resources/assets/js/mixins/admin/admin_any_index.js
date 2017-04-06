export default {
    methods: {
        confirmDeletingItem: function (id, row_id) {
            if (confirm('Are you sure?')) {
                document.getElementById(row_id + id).submit();
            }
        }
    }
}