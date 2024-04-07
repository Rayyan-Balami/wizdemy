function likeMaterial(studyMaterialId, element) {
    if (element.classList.contains('active')) {
        $.ajax({
            type: 'DELETE',
            url: '/api/material/unlike/' + studyMaterialId,
            success: function (response) {
                console.log(response);
                if (response.data.status === 'success') {
                    element.classList.remove('active');
                    element.querySelector('span').innerText = parseInt(element.querySelector('span').innerText) - 1;
                }
            } 
        });
    } else {
        $.ajax({
            type: 'POST',
            url: '/api/material/like/' + studyMaterialId,
            success: function (response) {
                console.log(response);
                if (response.data.status === 'success') {
                    element.classList.add('active');
                    element.querySelector('span').innerText = parseInt(element.querySelector('span').innerText) + 1;
                }
            }
        });
    }
}
