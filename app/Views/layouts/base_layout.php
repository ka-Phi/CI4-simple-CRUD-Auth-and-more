<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <p><?= $title ?></p>
    <?= $this->renderSection('content') ?>

    <script>
        const imgLoader = () => {
            const image = document.querySelector('#image')
            const imgPreview = document.querySelector('#img-preview')
            console.log(image.files[0].name)

            const file = new FileReader()
            file.readAsDataURL(image.files[0])

            file.onload = function(e) {
                imgPreview.src = e.target.result
            }
        }
    </script>
</body>
</html>