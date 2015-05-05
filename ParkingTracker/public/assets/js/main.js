/* Make all items with the data-goto-url attribute clickable and divert to that URL */
$('[data-goto-url]').click(function() {
    window.location.href = $(this).attr('data-goto-url');
});
