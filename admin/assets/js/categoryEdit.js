document
  .getElementById('categoryForm')
  .addEventListener('submit', function (event) {
    console.log('submit')
    event.preventDefault()

    // Получение данных из формы
    
    const form = document.getElementById('categoryForm');
    const categoryId = form.getAttribute('data-category-id');


    const formData = new FormData(form);
    formData.append('categoryId',categoryId)

    console.log(formData.get('image'))

    const image = formData.get('image')
    if(!image.size){
        formData.delete('image')
    }

    // Отправляем данные формы на сервер
    fetch('http://localhost/admin/categories/edit', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Обработка ответа от сервера, например, обновление интерфейса
        alert(data.message)
    })
    .catch(error => {
      alert(error.message)
    });
  })
