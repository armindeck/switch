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

switch ($view) {
    case "home":
        $list = read(pathFiles("list"));
        actions("add", ["list" => $list]);
        actions("delete", ["list" => $list]);
        $data = ["model" => $model, "list" => $list];
        break;

    case "login":
        $data = ["model" => $model];
        actions("login", $data);
        break;

    case "register":
        $data = ["model" => $model];
        actions("register", $data);
        break;

    case "logout":
        $model->logout();
        redirect("./login");
        break;

    default:
        $data = ["auth" => $model->auth()];

        // Profiles
        $exp = explode("/", $view);
        if (count($exp) == 2 && $exp[0] == "p"){
            $view = "profile";
            $data = ["auth" => $model->auth(), "user" => $exp[1]];
        } else {
            $view = "error";
        }
        break;
}

counter($view);
view("layout/$view", $data ?? []);