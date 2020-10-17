
$(document).ready(function () {
  function updateCategories() {

          var categorySelect = $('#category');
          var el = $('#brand');
          var selectedCategoryOption = categorySelect.find(":selected");
          var departmentId = selectedCategoryOption.attr('data-department');

            $.each(el.children(), function (index, element) {
                element = $(element);
                if (element.attr('data-department') !== departmentId) {
                  if(element.attr('data-department') != 0)
                  {
                    element.hide();
                  }

                } else
                {
                    element.show();
                }
            });
            $("#brand").val(0);
        }


  $(document).on('change', '#category', function (e) {
    updateCategories();
  });

  updateCategories();
})
