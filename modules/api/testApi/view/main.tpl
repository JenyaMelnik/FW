<div>
    <div class="">
        <h4>RESTful API manual for https://fw.loc/api:</h4>
        <table class="restApiDescription">
            <tr>
                <th>Action</th>
                <th>Method</th>
                <th>url</th>
            </tr>
            <tr>
                <td>Get secret_token to work with account</td>
                <td>POST</td>
                <td>/auth/login/{login}/{password}</td>
            </tr>
            <tr>
                <td>Get social networks list</td>
                <td>GET</td>
                <td>/socials/main</td>
            </tr>
            <tr>
                <td>remove auth via social network</td>
                <td>DELETE</td>
                <td>/socials/delete/{id}</td>
            </tr>

        </table>
        <br>
        <p>По умолчанию ответ приходит в формате JSON, если хотите изменить на XML: в конце зопроса добавте /xml</p>
        <br>
    </div>
    <div class="requestTestApi">
        <form action="" method="post" onsubmit="testApiRequest(); return false">
            <tr>
                <td>
                    <label>
                        <select id="action" style="height: 29px">
                            <option value="POST">POST</option>
                            <option value="GET">GET</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                    </label>
                </td>
                <td>
                    <label>
                        <input id="url" placeholder="введите URL">
                    </label>
                </td>
                <td>
                    <input type="submit" name="send" value="SEND">
                </td>
            </tr>
        </form>
    </div>
    <label for="responseTestApi"></label><textarea readonly style="width: 100%" id="responseTestApi"></textarea>
</div>
