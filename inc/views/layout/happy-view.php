<?php
/*
MIT License

Copyright (c) 2026 Armin Deck

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

view("components/header", ["auth" => $model->auth()]);
?>
    <main class="main">
        <?php view("components/message"); ?>
        <div class="content">
            <div class="button-switch-content">
                <a href="<?= route() ?>"><?= config("app_name") ?></a>
                <a href="<?= route("happy") ?>" class="active">Happy</a>
            </div>
        </div>
        <form class="form" method="post">
            <h2>Fechas de nacimiento</h2>
            <input type="text" name="name" id="name" value="<?= $get["name"] ?? "" ?>" placeholder="Nombre" title="Nombre" required>
            <input type="date" name="date" id="date" value="<?= $get["date"] ?? "" ?>" title="Date" required>
            <?php if(!empty($get["id"])): ?>
            <input type="text" name="id" id="id" value="<?= $get["id"] ?? "" ?>" placeholder="ID" title="ID" required  readonly>
            <?php endif ?>
            <button type="submit" name="<?= isset($get["id"]) ? "edit" : "add" ?>" value="<?= isset($get["id"]) ? "edit" : "add" ?>"><?= isset($get["id"]) ? "Edit" : "Add" ?></button>
        </form>
        <div class="p-8 scroll-auto">
            <table>
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Fecha</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?= $value["name"] ?></td>
                        <td title="<?= $value["date"] ?>"><?= strDate($value["date"]) ?></td>
                        <td>
                            <a href="?action=edit&id=<?= $key ?>">📝</a>
                            <a href="?action=delete&id=<?= $key ?>&confirm=1" onclick="return confirm('Quieres eliminar los datos de <?= $value["name"] ?>');">❌</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </main>
<?php view("components/footer"); ?>