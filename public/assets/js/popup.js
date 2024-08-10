$(document).ready(function() {
    $('#issuesModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var milestoneId = button.data('milestone-id');
        var modal = $(this);
        modal.find('#milestone_id').val(milestoneId);

        // Permintaan AJAX untuk mengambil issues untuk milestone
        $.ajax({
            url: '/fetch-issues/' + milestoneId,
            type: 'GET',
            success: function(response) {
                console.log(response);  // Log responsnya
                var issuesList = $('#issuesList');
                issuesList.empty(); // Hapus daftar sebelumnya

                // Tambahkan setiap issue ke dalam body modal
                response.issues.forEach(function(issue) {
                    var issueItem = $(
                        '<div class="form-check">' +
                        '<input class="form-check-input" type="checkbox" name="issues[]" value="' + issue.id + '"' + (issue.completed ? ' checked' : '') + '>' +
                        '<label class="form-check-label">' + issue.name + '</label>' +
                        '</div>'
                    );
                    issuesList.append(issueItem);
                });
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);  // Catat detail error
            }
        });
    });

    $('#issuesForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(data) {
                $('#issuesModal').modal('hide');
                // Opsional, Anda dapat me-refresh halaman atau bagian tertentu untuk mencerminkan perubahan
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
