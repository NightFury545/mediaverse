<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>MediaVerse API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-register">
                                <a href="#endpoints-POSTapi-auth-register">Реєстрація нового користувача.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-login">
                                <a href="#endpoints-POSTapi-auth-login">Логін користувача.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-logout">
                                <a href="#endpoints-POSTapi-auth-logout">Логаут користувача.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-refresh-token">
                                <a href="#endpoints-POSTapi-auth-refresh-token">Оновлення JWT токена</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-email-verify">
                                <a href="#endpoints-GETapi-email-verify">GET api/email/verify</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-email-verify--id---hash-">
                                <a href="#endpoints-GETapi-email-verify--id---hash-">GET api/email/verify/{id}/{hash}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-email-resend">
                                <a href="#endpoints-POSTapi-email-resend">POST api/email/resend</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-auth-google">
                                <a href="#endpoints-GETapi-auth-google">Перенаправлення на Google для авторизації.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-auth-google-callback">
                                <a href="#endpoints-GETapi-auth-google-callback">Callback після авторизації через Google.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-auth-github">
                                <a href="#endpoints-GETapi-auth-github">Перенаправлення на GitHub для авторизації.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-auth-github-callback">
                                <a href="#endpoints-GETapi-auth-github-callback">Callback після авторизації через GitHub.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-posts">
                                <a href="#endpoints-POSTapi-posts">Store a new post.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-posts--id-">
                                <a href="#endpoints-POSTapi-posts--id-">Update a specific post.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-posts--id-">
                                <a href="#endpoints-DELETEapi-posts--id-">Delete a specific post.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-posts">
                                <a href="#endpoints-GETapi-posts">Get a list of posts.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-posts--identifier-">
                                <a href="#endpoints-GETapi-posts--identifier-">Show a specific post.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-users">
                                <a href="#endpoints-GETapi-users">Get a list of users.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-users-me">
                                <a href="#endpoints-GETapi-users-me">GET api/users/me</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-users-top">
                                <a href="#endpoints-GETapi-users-top">Get the top 10 most active users.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-users--identifier-">
                                <a href="#endpoints-GETapi-users--identifier-">Show a specific user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-chats--chat_id--messages">
                                <a href="#endpoints-GETapi-chats--chat_id--messages">GET api/chats/{chat_id}/messages</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-messages">
                                <a href="#endpoints-POSTapi-messages">POST api/messages</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-messages--id-">
                                <a href="#endpoints-PUTapi-messages--id-">PUT api/messages/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-messages--id-">
                                <a href="#endpoints-DELETEapi-messages--id-">DELETE api/messages/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-friendships-send">
                                <a href="#endpoints-POSTapi-friendships-send">Відправлення запиту на дружбу.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-friendships--friendship_id--accept">
                                <a href="#endpoints-PUTapi-friendships--friendship_id--accept">Прийняття запиту на дружбу.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-friendships--friendship_id--reject">
                                <a href="#endpoints-PUTapi-friendships--friendship_id--reject">Відхилення запиту на дружбу.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-friendships--friendship_id--cancel">
                                <a href="#endpoints-DELETEapi-friendships--friendship_id--cancel">Скасування запиту на дружбу.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-friendships--friendship_id--remove">
                                <a href="#endpoints-DELETEapi-friendships--friendship_id--remove">Видалення друга.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-friendships--user_id--sent-requests">
                                <a href="#endpoints-GETapi-friendships--user_id--sent-requests">Отримання запитів на дружбу, що були надіслані.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-friendships--user_id--received-requests">
                                <a href="#endpoints-GETapi-friendships--user_id--received-requests">Отримання запитів на дружбу, що були отримані.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-friendships--user_id--friends">
                                <a href="#endpoints-GETapi-friendships--user_id--friends">Отримання списку друзів.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-chats">
                                <a href="#endpoints-GETapi-chats">GET api/chats</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-chats">
                                <a href="#endpoints-POSTapi-chats">POST api/chats</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-chats--chat_id-">
                                <a href="#endpoints-GETapi-chats--chat_id-">GET api/chats/{chat_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-chats--chat_id-">
                                <a href="#endpoints-PUTapi-chats--chat_id-">PUT api/chats/{chat_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-chats--chat_id-">
                                <a href="#endpoints-DELETEapi-chats--chat_id-">DELETE api/chats/{chat_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi--commentable_type---commentable--comments">
                                <a href="#endpoints-POSTapi--commentable_type---commentable--comments">Створює новий коментар для поста або фільму.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-comments--id-">
                                <a href="#endpoints-PUTapi-comments--id-">Оновлює коментар.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-comments--id-">
                                <a href="#endpoints-DELETEapi-comments--id-">Видаляє коментар.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user-comments">
                                <a href="#endpoints-GETapi-user-comments">Отримує коментарі користувача.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi--commentable_type---commentable--comments">
                                <a href="#endpoints-GETapi--commentable_type---commentable--comments">Отримує список коментарів для поста або фільму.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-comments--id-">
                                <a href="#endpoints-GETapi-comments--id-">Отримує конкретний коментар по його ID.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-comments--comment_id--replies">
                                <a href="#endpoints-GETapi-comments--comment_id--replies">Отримує відповіді на коментар.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-reports">
                                <a href="#endpoints-GETapi-reports">GET api/reports</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-reports">
                                <a href="#endpoints-POSTapi-reports">POST api/reports</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-reports--report_id-">
                                <a href="#endpoints-DELETEapi-reports--report_id-">DELETE api/reports/{report_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-post-views">
                                <a href="#endpoints-GETapi-post-views">Отримати список переглядів постів користувача.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-tags">
                                <a href="#endpoints-GETapi-tags">GET api/tags</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user-blocks">
                                <a href="#endpoints-GETapi-user-blocks">GET api/user-blocks</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-user-blocks">
                                <a href="#endpoints-POSTapi-user-blocks">POST api/user-blocks</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-user-blocks--userBlock_id-">
                                <a href="#endpoints-DELETEapi-user-blocks--userBlock_id-">DELETE api/user-blocks/{userBlock_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-user-status-online">
                                <a href="#endpoints-POSTapi-user-status-online">POST api/user/status/online</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-user-status-offline">
                                <a href="#endpoints-POSTapi-user-status-offline">POST api/user/status/offline</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user-status-online-ids">
                                <a href="#endpoints-GETapi-user-status-online-ids">GET api/user/status/online-ids</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi--likeable_type---likeable--likes">
                                <a href="#endpoints-POSTapi--likeable_type---likeable--likes">Додає лайк до поста, фільму або коментаря.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-likes--like_id-">
                                <a href="#endpoints-DELETEapi-likes--like_id-">Видаляє лайк.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user-likes">
                                <a href="#endpoints-GETapi-user-likes">GET api/user/likes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-notifications">
                                <a href="#endpoints-GETapi-notifications">Отримати всі нотифікації користувача</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-notifications-mark-as-read">
                                <a href="#endpoints-POSTapi-notifications-mark-as-read">Позначити всі нотифікації як прочитані</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-notifications--notificationId--mark-as-read">
                                <a href="#endpoints-POSTapi-notifications--notificationId--mark-as-read">Позначити одну нотифікацію як прочитану</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-notifications--notificationId-">
                                <a href="#endpoints-DELETEapi-notifications--notificationId-">Видалити одну нотифікацію</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-settings">
                                <a href="#endpoints-GETapi-settings">Get the authenticated user's settings.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-settings-notifications">
                                <a href="#endpoints-POSTapi-settings-notifications">Update notification setting.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-settings-message-privacy">
                                <a href="#endpoints-POSTapi-settings-message-privacy">Update message privacy setting.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-settings-friend-request-privacy">
                                <a href="#endpoints-POSTapi-settings-friend-request-privacy">Update friend request privacy setting.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-storage-private-post--directory---fileName-">
                                <a href="#endpoints-GETapi-storage-private-post--directory---fileName-">Віддає файл, прикріплений до поста, якщо користувач має доступ.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-storage-private-chat--directory---fileName-">
                                <a href="#endpoints-GETapi-storage-private-chat--directory---fileName-">Віддає файл, прикріплений до повідомлення в чаті, якщо користувач є учасником чату.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 28, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-auth-register">Реєстрація нового користувача.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"bngzmiyvdljnikhw\",
    \"email\": \"cormier.nick@example.com\",
    \"password\": \"\\/kXaz&lt;m5L[)~=NG5a:\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "bngzmiyvdljnikhw",
    "email": "cormier.nick@example.com",
    "password": "\/kXaz&lt;m5L[)~=NG5a:"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-register">
</span>
<span id="execution-results-POSTapi-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-register" data-method="POST"
      data-path="api/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-register"
                    onclick="tryItOut('POSTapi-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-register"
                    onclick="cancelTryOut('POSTapi-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-auth-register"
               value="bngzmiyvdljnikhw"
               data-component="body">
    <br>
<p>Must be at least 4 characters. Must not be greater than 16 characters. Example: <code>bngzmiyvdljnikhw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-register"
               value="cormier.nick@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 128 characters. Example: <code>cormier.nick@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-register"
               value="/kXaz<m5L[)~=NG5a:"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Must not be greater than 24 characters. Example: <code>/kXaz&lt;m5L[)~=NG5a:</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-login">Логін користувача.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"|]|{+-\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "|]|{+-"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-login">
</span>
<span id="execution-results-POSTapi-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-login" data-method="POST"
      data-path="api/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-login"
                    onclick="tryItOut('POSTapi-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-login"
                    onclick="cancelTryOut('POSTapi-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-login"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-login"
               value="|]|{+-"
               data-component="body">
    <br>
<p>Example: <code>|]|{+-</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-logout">Логаут користувача.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-logout">
</span>
<span id="execution-results-POSTapi-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-logout" data-method="POST"
      data-path="api/auth/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-logout"
                    onclick="tryItOut('POSTapi-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-logout"
                    onclick="cancelTryOut('POSTapi-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-auth-refresh-token">Оновлення JWT токена</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-refresh-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/refresh-token" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/refresh-token"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-refresh-token">
</span>
<span id="execution-results-POSTapi-auth-refresh-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-refresh-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-refresh-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-refresh-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-refresh-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-refresh-token" data-method="POST"
      data-path="api/auth/refresh-token"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-refresh-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-refresh-token"
                    onclick="tryItOut('POSTapi-auth-refresh-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-refresh-token"
                    onclick="cancelTryOut('POSTapi-auth-refresh-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-refresh-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/refresh-token</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-refresh-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-refresh-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-email-verify">GET api/email/verify</h2>

<p>
</p>



<span id="example-requests-GETapi-email-verify">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/email/verify" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/email/verify"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-email-verify">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:8000/auth.verify-email
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;http://localhost:8000/auth.verify-email&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:8000/auth.verify-email&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:8000/auth.verify-email&quot;&gt;http://localhost:8000/auth.verify-email&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-email-verify" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-email-verify"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-email-verify"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-email-verify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-email-verify">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-email-verify" data-method="GET"
      data-path="api/email/verify"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-email-verify', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-email-verify"
                    onclick="tryItOut('GETapi-email-verify');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-email-verify"
                    onclick="cancelTryOut('GETapi-email-verify');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-email-verify"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/email/verify</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-email-verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-email-verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-email-verify--id---hash-">GET api/email/verify/{id}/{hash}</h2>

<p>
</p>



<span id="example-requests-GETapi-email-verify--id---hash-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/email/verify/architecto/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/email/verify/architecto/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-email-verify--id---hash-">
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid signature.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-email-verify--id---hash-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-email-verify--id---hash-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-email-verify--id---hash-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-email-verify--id---hash-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-email-verify--id---hash-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-email-verify--id---hash-" data-method="GET"
      data-path="api/email/verify/{id}/{hash}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-email-verify--id---hash-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-email-verify--id---hash-"
                    onclick="tryItOut('GETapi-email-verify--id---hash-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-email-verify--id---hash-"
                    onclick="cancelTryOut('GETapi-email-verify--id---hash-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-email-verify--id---hash-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/email/verify/{id}/{hash}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-email-verify--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-email-verify--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-email-verify--id---hash-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the verify. Example: <code>architecto</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>hash</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hash"                data-endpoint="GETapi-email-verify--id---hash-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-email-resend">POST api/email/resend</h2>

<p>
</p>



<span id="example-requests-POSTapi-email-resend">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/email/resend" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/email/resend"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-email-resend">
</span>
<span id="execution-results-POSTapi-email-resend" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-email-resend"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-email-resend"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-email-resend" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-email-resend">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-email-resend" data-method="POST"
      data-path="api/email/resend"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-email-resend', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-email-resend"
                    onclick="tryItOut('POSTapi-email-resend');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-email-resend"
                    onclick="cancelTryOut('POSTapi-email-resend');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-email-resend"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/email/resend</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-email-resend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-email-resend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-auth-google">Перенаправлення на Google для авторизації.</h2>

<p>
</p>



<span id="example-requests-GETapi-auth-google">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/auth/google" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/google"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-google">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: https://accounts.google.com/o/oauth2/auth?client_id=143785705553-m4l50v775tptlj4ld6q78o6oakccjo9d.apps.googleusercontent.com&amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;scope=openid+profile+email&amp;response_type=code
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;https://accounts.google.com/o/oauth2/auth?client_id=143785705553-m4l50v775tptlj4ld6q78o6oakccjo9d.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to https://accounts.google.com/o/oauth2/auth?client_id=143785705553-m4l50v775tptlj4ld6q78o6oakccjo9d.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;https://accounts.google.com/o/oauth2/auth?client_id=143785705553-m4l50v775tptlj4ld6q78o6oakccjo9d.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&quot;&gt;https://accounts.google.com/o/oauth2/auth?client_id=143785705553-m4l50v775tptlj4ld6q78o6oakccjo9d.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-google" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-google"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-google"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-google" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-google">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-google" data-method="GET"
      data-path="api/auth/google"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-google', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-google"
                    onclick="tryItOut('GETapi-auth-google');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-google"
                    onclick="cancelTryOut('GETapi-auth-google');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-google"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/google</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-google"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-google"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-auth-google-callback">Callback після авторизації через Google.</h2>

<p>
</p>



<span id="example-requests-GETapi-auth-google-callback">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/auth/google/callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/google/callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-google-callback">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:8000
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;http://localhost:8000&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:8000&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:8000&quot;&gt;http://localhost:8000&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-google-callback" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-google-callback"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-google-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-google-callback" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-google-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-google-callback" data-method="GET"
      data-path="api/auth/google/callback"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-google-callback', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-google-callback"
                    onclick="tryItOut('GETapi-auth-google-callback');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-google-callback"
                    onclick="cancelTryOut('GETapi-auth-google-callback');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-google-callback"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/google/callback</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-google-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-google-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-auth-github">Перенаправлення на GitHub для авторизації.</h2>

<p>
</p>



<span id="example-requests-GETapi-auth-github">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/auth/github" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/github"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-github">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: https://github.com/login/oauth/authorize?client_id=Ov23lip40EYRQF2ZwoE3&amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgithub%2Fcallback&amp;scope=user%3Aemail&amp;response_type=code
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;https://github.com/login/oauth/authorize?client_id=Ov23lip40EYRQF2ZwoE3&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgithub%2Fcallback&amp;amp;scope=user%3Aemail&amp;amp;response_type=code&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to https://github.com/login/oauth/authorize?client_id=Ov23lip40EYRQF2ZwoE3&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgithub%2Fcallback&amp;amp;scope=user%3Aemail&amp;amp;response_type=code&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;https://github.com/login/oauth/authorize?client_id=Ov23lip40EYRQF2ZwoE3&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgithub%2Fcallback&amp;amp;scope=user%3Aemail&amp;amp;response_type=code&quot;&gt;https://github.com/login/oauth/authorize?client_id=Ov23lip40EYRQF2ZwoE3&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgithub%2Fcallback&amp;amp;scope=user%3Aemail&amp;amp;response_type=code&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-github" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-github"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-github"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-github" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-github">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-github" data-method="GET"
      data-path="api/auth/github"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-github', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-github"
                    onclick="tryItOut('GETapi-auth-github');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-github"
                    onclick="cancelTryOut('GETapi-auth-github');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-github"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/github</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-github"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-github"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-auth-github-callback">Callback після авторизації через GitHub.</h2>

<p>
</p>



<span id="example-requests-GETapi-auth-github-callback">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/auth/github/callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/github/callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-github-callback">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:8000
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;http://localhost:8000&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:8000&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:8000&quot;&gt;http://localhost:8000&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-github-callback" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-github-callback"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-github-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-github-callback" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-github-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-github-callback" data-method="GET"
      data-path="api/auth/github/callback"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-github-callback', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-github-callback"
                    onclick="tryItOut('GETapi-auth-github-callback');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-github-callback"
                    onclick="cancelTryOut('GETapi-auth-github-callback');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-github-callback"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/github/callback</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-github-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-github-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-posts">Store a new post.</h2>

<p>
</p>



<span id="example-requests-POSTapi-posts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/posts" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=b"\
    --form "content=n"\
    --form "tags[]=gzmiyvdljnikhway"\
    --form "visibility=friends"\
    --form "comments_enabled=1"\
    --form "attachments[]=@C:\Users\user1\AppData\Local\Temp\php7C62.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/posts"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'b');
body.append('content', 'n');
body.append('tags[]', 'gzmiyvdljnikhway');
body.append('visibility', 'friends');
body.append('comments_enabled', '1');
body.append('attachments[]', document.querySelector('input[name="attachments[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-posts">
</span>
<span id="execution-results-POSTapi-posts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-posts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-posts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-posts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-posts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-posts" data-method="POST"
      data-path="api/posts"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-posts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-posts"
                    onclick="tryItOut('POSTapi-posts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-posts"
                    onclick="cancelTryOut('POSTapi-posts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-posts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/posts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-posts"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-posts"
               value="b"
               data-component="body">
    <br>
<p>Must be at least 3 characters. Must not be greater than 36 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-posts"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 564 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="tags[0]"                data-endpoint="POSTapi-posts"
               data-component="body">
        <input type="text" style="display: none"
               name="tags[1]"                data-endpoint="POSTapi-posts"
               data-component="body">
    <br>
<p>Must be at least 2 characters. Must not be greater than 24 characters.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachments</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="attachments[0]"                data-endpoint="POSTapi-posts"
               data-component="body">
        <input type="file" style="display: none"
               name="attachments[1]"                data-endpoint="POSTapi-posts"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visibility</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="visibility"                data-endpoint="POSTapi-posts"
               value="friends"
               data-component="body">
    <br>
<p>Example: <code>friends</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>public</code></li> <li><code>private</code></li> <li><code>friends</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comments_enabled</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-posts" style="display: none">
            <input type="radio" name="comments_enabled"
                   value="true"
                   data-endpoint="POSTapi-posts"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-posts" style="display: none">
            <input type="radio" name="comments_enabled"
                   value="false"
                   data-endpoint="POSTapi-posts"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-posts--id-">Update a specific post.</h2>

<p>
</p>



<span id="example-requests-POSTapi-posts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/posts/9efba248-77c1-4133-b827-cc5491290705" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=b"\
    --form "content=n"\
    --form "tags[]=gzmiyvdljnikhway"\
    --form "visibility=friends"\
    --form "comments_enabled="\
    --form "attachments[]=@C:\Users\user1\AppData\Local\Temp\php7C73.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/posts/9efba248-77c1-4133-b827-cc5491290705"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'b');
body.append('content', 'n');
body.append('tags[]', 'gzmiyvdljnikhway');
body.append('visibility', 'friends');
body.append('comments_enabled', '');
body.append('attachments[]', document.querySelector('input[name="attachments[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-posts--id-">
</span>
<span id="execution-results-POSTapi-posts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-posts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-posts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-posts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-posts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-posts--id-" data-method="POST"
      data-path="api/posts/{id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-posts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-posts--id-"
                    onclick="tryItOut('POSTapi-posts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-posts--id-"
                    onclick="cancelTryOut('POSTapi-posts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-posts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/posts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-posts--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-posts--id-"
               value="9efba248-77c1-4133-b827-cc5491290705"
               data-component="url">
    <br>
<p>The ID of the post. Example: <code>9efba248-77c1-4133-b827-cc5491290705</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-posts--id-"
               value="b"
               data-component="body">
    <br>
<p>Must be at least 3 characters. Must not be greater than 36 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-posts--id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 564 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="tags[0]"                data-endpoint="POSTapi-posts--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="tags[1]"                data-endpoint="POSTapi-posts--id-"
               data-component="body">
    <br>
<p>Must be at least 2 characters. Must not be greater than 24 characters.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachments</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="attachments[0]"                data-endpoint="POSTapi-posts--id-"
               data-component="body">
        <input type="file" style="display: none"
               name="attachments[1]"                data-endpoint="POSTapi-posts--id-"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visibility</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="visibility"                data-endpoint="POSTapi-posts--id-"
               value="friends"
               data-component="body">
    <br>
<p>Example: <code>friends</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>public</code></li> <li><code>private</code></li> <li><code>friends</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comments_enabled</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-posts--id-" style="display: none">
            <input type="radio" name="comments_enabled"
                   value="true"
                   data-endpoint="POSTapi-posts--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-posts--id-" style="display: none">
            <input type="radio" name="comments_enabled"
                   value="false"
                   data-endpoint="POSTapi-posts--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-posts--id-">Delete a specific post.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-posts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/posts/9efba248-77c1-4133-b827-cc5491290705" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/posts/9efba248-77c1-4133-b827-cc5491290705"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-posts--id-">
</span>
<span id="execution-results-DELETEapi-posts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-posts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-posts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-posts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-posts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-posts--id-" data-method="DELETE"
      data-path="api/posts/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-posts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-posts--id-"
                    onclick="tryItOut('DELETEapi-posts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-posts--id-"
                    onclick="cancelTryOut('DELETEapi-posts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-posts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/posts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-posts--id-"
               value="9efba248-77c1-4133-b827-cc5491290705"
               data-component="url">
    <br>
<p>The ID of the post. Example: <code>9efba248-77c1-4133-b827-cc5491290705</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-posts">Get a list of posts.</h2>

<p>
</p>



<span id="example-requests-GETapi-posts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/posts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/posts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-posts">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
            &quot;title&quot;: &quot;Просто пост&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Крутий пост для тестування&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efba138-5629-4348-b52f-a4d72e576189&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/41ab5d78-d034-4a94-bc2d-d0fdf7823249.webp&quot;
            ],
            &quot;slug&quot;: &quot;prosto-post&quot;,
            &quot;likes_count&quot;: 1,
            &quot;comments_count&quot;: 4,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 3,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-25T17:46:23.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efba138-5629-4348-b52f-a4d72e576189&quot;,
                &quot;username&quot;: &quot;Denus&quot;,
                &quot;first_name&quot;: null,
                &quot;last_name&quot;: null,
                &quot;email&quot;: &quot;justtest@gmail.com&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-24T00:00:00.000000Z&quot;,
                &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: null,
                &quot;birthday&quot;: null,
                &quot;country&quot;: null,
                &quot;gender&quot;: null,
                &quot;is_online&quot;: false,
                &quot;last_seen_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T21:29:48.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;
            },
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: &quot;9efba248-97c6-4110-b434-adc18070d706&quot;,
                    &quot;name&quot;: &quot;tech&quot;,
                    &quot;slug&quot;: &quot;tech-tech&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-97c6-4110-b434-adc18070d706&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;,
                    &quot;name&quot;: &quot;science&quot;,
                    &quot;slug&quot;: &quot;science-science&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;,
                    &quot;name&quot;: &quot;coding&quot;,
                    &quot;slug&quot;: &quot;coding-coding&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;
                    }
                }
            ]
        },
        {
            &quot;id&quot;: &quot;9efd1d77-71ff-416d-9426-d8341f352779&quot;,
            &quot;title&quot;: &quot;Крутий пост!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Топовий пост да!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: null,
            &quot;slug&quot;: &quot;krutii-post&quot;,
            &quot;likes_count&quot;: 1,
            &quot;comments_count&quot;: 10,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 2,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-24T15:13:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-26T21:03:26.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;,
                    &quot;name&quot;: &quot;science&quot;,
                    &quot;slug&quot;: &quot;science-science&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9efd1d77-71ff-416d-9426-d8341f352779&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;,
                    &quot;name&quot;: &quot;coding&quot;,
                    &quot;slug&quot;: &quot;coding-coding&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9efd1d77-71ff-416d-9426-d8341f352779&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efd1d77-9244-46d4-9cbe-3b9305077aba&quot;,
                    &quot;name&quot;: &quot;news&quot;,
                    &quot;slug&quot;: &quot;news-news&quot;,
                    &quot;created_at&quot;: &quot;2025-05-24T15:13:02.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-24T15:13:02.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9efd1d77-71ff-416d-9426-d8341f352779&quot;,
                        &quot;tag_id&quot;: &quot;9efd1d77-9244-46d4-9cbe-3b9305077aba&quot;
                    }
                }
            ]
        },
        {
            &quot;id&quot;: &quot;9eff510c-0205-4893-9d66-f9fd45614f74&quot;,
            &quot;title&quot;: &quot;dwad&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Привіт! Це редагований пост!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/70448e03-2fe8-4eab-b1e7-8a7e1e5dbd7b.webp&quot;
            ],
            &quot;slug&quot;: &quot;dwad&quot;,
            &quot;likes_count&quot;: 1,
            &quot;comments_count&quot;: 1,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 1,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-25T17:28:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T13:09:08.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;,
                    &quot;name&quot;: &quot;science&quot;,
                    &quot;slug&quot;: &quot;science-science&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9eff510c-0205-4893-9d66-f9fd45614f74&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;,
                    &quot;name&quot;: &quot;coding&quot;,
                    &quot;slug&quot;: &quot;coding-coding&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9eff510c-0205-4893-9d66-f9fd45614f74&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;
                    }
                }
            ]
        },
        {
            &quot;id&quot;: &quot;9eff51e5-5876-448a-9107-95004f0196f5&quot;,
            &quot;title&quot;: &quot;Куку&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;ПРивіт це крутий пост!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: null,
            &quot;slug&quot;: &quot;kuku&quot;,
            &quot;likes_count&quot;: 1,
            &quot;comments_count&quot;: 2,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 2,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-25T17:31:18.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T13:01:46.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;,
                    &quot;name&quot;: &quot;science&quot;,
                    &quot;slug&quot;: &quot;science-science&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9eff51e5-5876-448a-9107-95004f0196f5&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;,
                    &quot;name&quot;: &quot;coding&quot;,
                    &quot;slug&quot;: &quot;coding-coding&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9eff51e5-5876-448a-9107-95004f0196f5&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9eff51e5-5c44-4bc9-a77c-ef3bf020457f&quot;,
                    &quot;name&quot;: &quot;sports&quot;,
                    &quot;slug&quot;: &quot;sports-sports&quot;,
                    &quot;created_at&quot;: &quot;2025-05-25T17:31:18.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-25T17:31:18.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9eff51e5-5876-448a-9107-95004f0196f5&quot;,
                        &quot;tag_id&quot;: &quot;9eff51e5-5c44-4bc9-a77c-ef3bf020457f&quot;
                    }
                }
            ]
        },
        {
            &quot;id&quot;: &quot;9eff5262-69b7-4fd7-9b2d-8b34e44691e7&quot;,
            &quot;title&quot;: &quot;Пост без коментарів!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Не залишайте коментарі!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: null,
            &quot;slug&quot;: &quot;post-bez-komentariv&quot;,
            &quot;likes_count&quot;: 1,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 1,
            &quot;comments_enabled&quot;: false,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-25T17:32:40.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T12:46:41.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f01004c-fabf-478e-9a7d-853a5a11838e&quot;,
            &quot;title&quot;: &quot;Тестування&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Для тестування!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/2d1d1d81-308f-41b2-8373-76e822b558a2.webp&quot;,
                &quot;attachments/f8b8137c-1fc8-49a6-add1-e649a847393f.webp&quot;
            ],
            &quot;slug&quot;: &quot;testuvannia&quot;,
            &quot;likes_count&quot;: 1,
            &quot;comments_count&quot;: 1,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 1,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-26T13:34:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T13:03:59.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;,
                    &quot;name&quot;: &quot;science&quot;,
                    &quot;slug&quot;: &quot;science-science&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9f01004c-fabf-478e-9a7d-853a5a11838e&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efd1d77-9244-46d4-9cbe-3b9305077aba&quot;,
                    &quot;name&quot;: &quot;news&quot;,
                    &quot;slug&quot;: &quot;news-news&quot;,
                    &quot;created_at&quot;: &quot;2025-05-24T15:13:02.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-24T15:13:02.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9f01004c-fabf-478e-9a7d-853a5a11838e&quot;,
                        &quot;tag_id&quot;: &quot;9efd1d77-9244-46d4-9cbe-3b9305077aba&quot;
                    }
                }
            ]
        },
        {
            &quot;id&quot;: &quot;9f0300e7-d860-4b33-891a-89faa86bd615&quot;,
            &quot;title&quot;: &quot;Крутий пост!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Пост створений виключно з метою тестування.&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: null,
            &quot;slug&quot;: &quot;krutii-post-1&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 1,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T13:28:09.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T13:28:10.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: &quot;9efba248-97c6-4110-b434-adc18070d706&quot;,
                    &quot;name&quot;: &quot;tech&quot;,
                    &quot;slug&quot;: &quot;tech-tech&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9f0300e7-d860-4b33-891a-89faa86bd615&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-97c6-4110-b434-adc18070d706&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;,
                    &quot;name&quot;: &quot;coding&quot;,
                    &quot;slug&quot;: &quot;coding-coding&quot;,
                    &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9f0300e7-d860-4b33-891a-89faa86bd615&quot;,
                        &quot;tag_id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;
                    }
                },
                {
                    &quot;id&quot;: &quot;9f0300e8-0cef-44b8-9312-8446858a8b3c&quot;,
                    &quot;name&quot;: &quot;аніме&quot;,
                    &quot;slug&quot;: &quot;anime-anime&quot;,
                    &quot;created_at&quot;: &quot;2025-05-27T13:28:09.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-05-27T13:28:09.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;post_id&quot;: &quot;9f0300e7-d860-4b33-891a-89faa86bd615&quot;,
                        &quot;tag_id&quot;: &quot;9f0300e8-0cef-44b8-9312-8446858a8b3c&quot;
                    }
                }
            ]
        },
        {
            &quot;id&quot;: &quot;9f030bd0-35ba-4e1c-924a-ce346382a364&quot;,
            &quot;title&quot;: &quot;Пост для тестування!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Цей пост створено для тестування функціональності.&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/e52281c8-22f5-4173-8262-519605017f00.webp&quot;
            ],
            &quot;slug&quot;: &quot;post-dlia-testuvannia&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 1,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T13:58:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T13:58:40.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f030eb8-34b1-4626-b504-1f7f0f52b6c2&quot;,
            &quot;title&quot;: &quot;Тест!!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;тактактак!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/2298b93f-62d8-486a-a8c3-dea78d044ce0.webp&quot;,
                &quot;attachments/eee1fd97-e7bb-4b57-bff3-1e63fdbac532.webp&quot;
            ],
            &quot;slug&quot;: &quot;test&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:06:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:06:46.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f030f19-5720-47fa-9ce4-bc3adaa22019&quot;,
            &quot;title&quot;: &quot;Тест!!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;тактактак!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/4fa52f3b-a7db-4cca-afce-4173df06ebe1.webp&quot;,
                &quot;attachments/83f1a37d-d5e2-4484-8d84-a740432bca7e.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-1&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:07:50.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:07:50.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f030f5f-70eb-403e-9283-b3860b84536c&quot;,
            &quot;title&quot;: &quot;Тест!!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;тактактак!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/c020f68f-54dc-4fd7-af2d-733417b451f8.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-2&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:08:36.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:08:36.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f030fdb-bd6c-475a-ab23-c37296ce5e91&quot;,
            &quot;title&quot;: &quot;Тест!!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;тактактак!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/660f024d-b160-4427-acd6-0b9a14285232.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-3&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 1,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:09:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:09:58.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f03101b-ae66-4d0c-b8a3-1c03a66d18f3&quot;,
            &quot;title&quot;: &quot;Тест 2&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Тестування створення поста 2&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/dbb23a95-e0da-4873-9eec-f1bca3f0d39e.webp&quot;,
                &quot;attachments/3fbde4d1-70e0-45ff-9493-c87e137eb892.webp&quot;,
                &quot;attachments/49284872-6331-4af8-9e5e-f51d3f7e7b5c.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-2-1&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:10:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:10:39.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f031046-a969-4794-b852-a77cc75f0838&quot;,
            &quot;title&quot;: &quot;Тест 2&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Тестування створення поста 2&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/6938d7eb-2bf6-4f80-87ce-8cb8a4e25fc8.webp&quot;,
                &quot;attachments/1d5c2dac-9e4c-48f4-a22d-6f689388f1fc.webp&quot;,
                &quot;attachments/216070f0-ca24-4fb5-9296-19df54be0111.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-2-2&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:11:07.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:11:07.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f031069-db48-4e43-9ea2-06f7ec8a105d&quot;,
            &quot;title&quot;: &quot;Тест 2&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Тестування створення поста 2&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/88a7ba70-bb68-4d98-a7c3-c6e0abf33003.webp&quot;,
                &quot;attachments/2832536c-5f7a-4109-a0af-3e0e69a7aaec.webp&quot;,
                &quot;attachments/4f96752a-6864-4513-ba89-7747b86d1765.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-2-3&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:11:30.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:11:30.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f03110e-88ea-43d2-a80e-07006888e575&quot;,
            &quot;title&quot;: &quot;Тест 2&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Тестування створення поста 2&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/2ed1af7a-2056-4294-a8c8-f69b5e6ce380.webp&quot;,
                &quot;attachments/4335ae4c-013b-432b-bbce-bd004b792547.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-2-4&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:13:18.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:13:18.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f03116d-3420-48f3-b218-e102091ff6f4&quot;,
            &quot;title&quot;: &quot;Тест 2&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Тестування створення поста 2&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/ddd659c8-d717-4fdb-a003-401b1756af4b.webp&quot;,
                &quot;attachments/9f8e84bd-4692-4bce-afed-bcc99cb2a4cc.webp&quot;
            ],
            &quot;slug&quot;: &quot;test-2-5&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 0,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:14:20.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:14:20.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        },
        {
            &quot;id&quot;: &quot;9f0311ad-6950-4aef-98b8-688ef83f0df8&quot;,
            &quot;title&quot;: &quot;Тест 2. Редагування!&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Тестування створення поста 2. Редагування!&lt;/p&gt;&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;attachments&quot;: [
                &quot;attachments/e0f8266b-4df1-4950-8846-c08aafd73e11.jpg&quot;
            ],
            &quot;slug&quot;: &quot;test-2-redaguvannia&quot;,
            &quot;likes_count&quot;: 0,
            &quot;comments_count&quot;: 0,
            &quot;reports_count&quot;: 0,
            &quot;views_count&quot;: 2,
            &quot;comments_enabled&quot;: true,
            &quot;visibility&quot;: &quot;public&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T14:15:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:44:38.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
                &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;role&quot;: &quot;user&quot;,
                &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
                &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
                &quot;country&quot;: null,
                &quot;gender&quot;: &quot;male&quot;,
                &quot;is_online&quot;: true,
                &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
                &quot;is_blocked&quot;: false,
                &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
            },
            &quot;tags&quot;: []
        }
    ],
    &quot;path&quot;: &quot;http://localhost:8000/api/posts&quot;,
    &quot;per_page&quot;: 20,
    &quot;next_cursor&quot;: null,
    &quot;next_page_url&quot;: null,
    &quot;prev_cursor&quot;: null,
    &quot;prev_page_url&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-posts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-posts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-posts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-posts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-posts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-posts" data-method="GET"
      data-path="api/posts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-posts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-posts"
                    onclick="tryItOut('GETapi-posts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-posts"
                    onclick="cancelTryOut('GETapi-posts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-posts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/posts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-posts--identifier-">Show a specific post.</h2>

<p>
</p>



<span id="example-requests-GETapi-posts--identifier-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/posts/9efba248-77c1-4133-b827-cc5491290705" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/posts/9efba248-77c1-4133-b827-cc5491290705"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-posts--identifier-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
        &quot;title&quot;: &quot;Просто пост&quot;,
        &quot;content&quot;: &quot;&lt;p&gt;Крутий пост для тестування&lt;/p&gt;&quot;,
        &quot;user_id&quot;: &quot;9efba138-5629-4348-b52f-a4d72e576189&quot;,
        &quot;attachments&quot;: [
            &quot;attachments/41ab5d78-d034-4a94-bc2d-d0fdf7823249.webp&quot;
        ],
        &quot;slug&quot;: &quot;prosto-post&quot;,
        &quot;likes_count&quot;: 1,
        &quot;comments_count&quot;: 4,
        &quot;reports_count&quot;: 0,
        &quot;views_count&quot;: 3,
        &quot;comments_enabled&quot;: true,
        &quot;visibility&quot;: &quot;public&quot;,
        &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-05-25T17:46:23.000000Z&quot;,
        &quot;user_liked&quot;: false,
        &quot;like_id&quot;: null,
        &quot;user&quot;: {
            &quot;id&quot;: &quot;9efba138-5629-4348-b52f-a4d72e576189&quot;,
            &quot;username&quot;: &quot;Denus&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;justtest@gmail.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-05-24T00:00:00.000000Z&quot;,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T21:29:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;
        },
        &quot;tags&quot;: [
            {
                &quot;id&quot;: &quot;9efba248-97c6-4110-b434-adc18070d706&quot;,
                &quot;name&quot;: &quot;tech&quot;,
                &quot;slug&quot;: &quot;tech-tech&quot;,
                &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;post_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
                    &quot;tag_id&quot;: &quot;9efba248-97c6-4110-b434-adc18070d706&quot;
                }
            },
            {
                &quot;id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;,
                &quot;name&quot;: &quot;science&quot;,
                &quot;slug&quot;: &quot;science-science&quot;,
                &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;post_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
                    &quot;tag_id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;
                }
            },
            {
                &quot;id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;,
                &quot;name&quot;: &quot;coding&quot;,
                &quot;slug&quot;: &quot;coding-coding&quot;,
                &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;post_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
                    &quot;tag_id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;
                }
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-posts--identifier-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-posts--identifier-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-posts--identifier-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-posts--identifier-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-posts--identifier-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-posts--identifier-" data-method="GET"
      data-path="api/posts/{identifier}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-posts--identifier-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-posts--identifier-"
                    onclick="tryItOut('GETapi-posts--identifier-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-posts--identifier-"
                    onclick="cancelTryOut('GETapi-posts--identifier-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-posts--identifier-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/posts/{identifier}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-posts--identifier-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-posts--identifier-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>identifier</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="identifier"                data-endpoint="GETapi-posts--identifier-"
               value="9efba248-77c1-4133-b827-cc5491290705"
               data-component="url">
    <br>
<p>Example: <code>9efba248-77c1-4133-b827-cc5491290705</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-users">Get a list of users.</h2>

<p>
</p>



<span id="example-requests-GETapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;username&quot;: &quot;Ruslan&quot;,
            &quot;first_name&quot;: &quot;Руслан&quot;,
            &quot;last_name&quot;: &quot;Чорнопиский&quot;,
            &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
            &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
            &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
            &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
            &quot;country&quot;: null,
            &quot;gender&quot;: &quot;male&quot;,
            &quot;is_online&quot;: true,
            &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;9efaf921-f915-44c8-8c1d-679fb676be77&quot;,
            &quot;username&quot;: &quot;ruslancornopiskii&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;brawltop155@gmail.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-05-23T13:39:47.000000Z&quot;,
            &quot;avatar&quot;: &quot;https://lh3.googleusercontent.com/a/ACg8ocIadrJhwkK91fuqsnD9s1c9e-EFEbpRPG8nBM200gnDwxzyfw=s96-c&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: true,
            &quot;last_seen_at&quot;: &quot;2025-05-24T14:07:04.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T13:39:47.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-24T14:08:38.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;9efb8cee-6224-4c5d-9d6c-329f6df58045&quot;,
            &quot;username&quot;: &quot;NightFury545&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;test@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: null,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T20:33:04.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T20:33:04.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;9efb8d24-7cb0-4f32-8d59-2bd0fe8cafa1&quot;,
            &quot;username&quot;: &quot;NightFurywrrw&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;tesdawt@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: &quot;2025-05-23T21:13:29.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T20:33:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:13:29.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;9efba138-5629-4348-b52f-a4d72e576189&quot;,
            &quot;username&quot;: &quot;Denus&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;justtest@gmail.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-05-24T00:00:00.000000Z&quot;,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T21:29:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;9f019827-21cb-4c8a-a2a2-d206e2bf5719&quot;,
            &quot;username&quot;: &quot;Ruslannnnnn&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;fortest@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: null,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-26T20:39:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-26T20:39:24.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;9f01985b-ea40-436a-9d05-dd869645b51d&quot;,
            &quot;username&quot;: &quot;Ruslann4112&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;fortest123321@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: &quot;2025-05-26T20:55:19.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-26T20:39:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-26T20:55:19.000000Z&quot;
        }
    ],
    &quot;path&quot;: &quot;http://localhost:8000/api/users&quot;,
    &quot;per_page&quot;: 10,
    &quot;next_cursor&quot;: null,
    &quot;next_page_url&quot;: null,
    &quot;prev_cursor&quot;: null,
    &quot;prev_page_url&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users" data-method="GET"
      data-path="api/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users"
                    onclick="tryItOut('GETapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users"
                    onclick="cancelTryOut('GETapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-users-me">GET api/users/me</h2>

<p>
</p>



<span id="example-requests-GETapi-users-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/users/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/users/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users-me">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users-me" data-method="GET"
      data-path="api/users/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users-me"
                    onclick="tryItOut('GETapi-users-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users-me"
                    onclick="cancelTryOut('GETapi-users-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-users-top">Get the top 10 most active users.</h2>

<p>
</p>



<span id="example-requests-GETapi-users-top">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/users/top" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/users/top"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users-top">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;username&quot;: &quot;Ruslan&quot;,
            &quot;first_name&quot;: &quot;Руслан&quot;,
            &quot;last_name&quot;: &quot;Чорнопиский&quot;,
            &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
            &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
            &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
            &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
            &quot;country&quot;: null,
            &quot;gender&quot;: &quot;male&quot;,
            &quot;is_online&quot;: true,
            &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;,
            &quot;likes_given&quot;: 70,
            &quot;comments_given&quot;: 70
        },
        {
            &quot;id&quot;: &quot;9efaf921-f915-44c8-8c1d-679fb676be77&quot;,
            &quot;username&quot;: &quot;ruslancornopiskii&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;brawltop155@gmail.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-05-23T13:39:47.000000Z&quot;,
            &quot;avatar&quot;: &quot;https://lh3.googleusercontent.com/a/ACg8ocIadrJhwkK91fuqsnD9s1c9e-EFEbpRPG8nBM200gnDwxzyfw=s96-c&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: true,
            &quot;last_seen_at&quot;: &quot;2025-05-24T14:07:04.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T13:39:47.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-24T14:08:38.000000Z&quot;,
            &quot;likes_given&quot;: 0,
            &quot;comments_given&quot;: 8
        },
        {
            &quot;id&quot;: &quot;9efb8cee-6224-4c5d-9d6c-329f6df58045&quot;,
            &quot;username&quot;: &quot;NightFury545&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;test@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: null,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T20:33:04.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T20:33:04.000000Z&quot;,
            &quot;likes_given&quot;: 0,
            &quot;comments_given&quot;: 0
        },
        {
            &quot;id&quot;: &quot;9efb8d24-7cb0-4f32-8d59-2bd0fe8cafa1&quot;,
            &quot;username&quot;: &quot;NightFurywrrw&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;tesdawt@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: &quot;2025-05-23T21:13:29.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T20:33:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:13:29.000000Z&quot;,
            &quot;likes_given&quot;: 0,
            &quot;comments_given&quot;: 0
        },
        {
            &quot;id&quot;: &quot;9efba138-5629-4348-b52f-a4d72e576189&quot;,
            &quot;username&quot;: &quot;Denus&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;justtest@gmail.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-05-24T00:00:00.000000Z&quot;,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-23T21:29:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:35:36.000000Z&quot;,
            &quot;likes_given&quot;: 0,
            &quot;comments_given&quot;: 0
        },
        {
            &quot;id&quot;: &quot;9f019827-21cb-4c8a-a2a2-d206e2bf5719&quot;,
            &quot;username&quot;: &quot;Ruslannnnnn&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;fortest@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: null,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-26T20:39:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-26T20:39:24.000000Z&quot;,
            &quot;likes_given&quot;: 0,
            &quot;comments_given&quot;: 0
        },
        {
            &quot;id&quot;: &quot;9f01985b-ea40-436a-9d05-dd869645b51d&quot;,
            &quot;username&quot;: &quot;Ruslann4112&quot;,
            &quot;first_name&quot;: null,
            &quot;last_name&quot;: null,
            &quot;email&quot;: &quot;fortest123321@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;avatar&quot;: &quot;http://localhost:8000/storage/avatars/default-avatar.webp&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;biography&quot;: null,
            &quot;birthday&quot;: null,
            &quot;country&quot;: null,
            &quot;gender&quot;: null,
            &quot;is_online&quot;: false,
            &quot;last_seen_at&quot;: &quot;2025-05-26T20:55:19.000000Z&quot;,
            &quot;is_blocked&quot;: false,
            &quot;created_at&quot;: &quot;2025-05-26T20:39:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-26T20:55:19.000000Z&quot;,
            &quot;likes_given&quot;: 0,
            &quot;comments_given&quot;: 0
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users-top" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users-top"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users-top"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users-top" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users-top">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users-top" data-method="GET"
      data-path="api/users/top"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users-top', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users-top"
                    onclick="tryItOut('GETapi-users-top');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users-top"
                    onclick="cancelTryOut('GETapi-users-top');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users-top"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/top</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users-top"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users-top"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-users--identifier-">Show a specific user.</h2>

<p>
</p>



<span id="example-requests-GETapi-users--identifier-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/users/9efaf65d-93c7-48dd-be37-cf8894bc225d" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/users/9efaf65d-93c7-48dd-be37-cf8894bc225d"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--identifier-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
        &quot;username&quot;: &quot;Ruslan&quot;,
        &quot;first_name&quot;: &quot;Руслан&quot;,
        &quot;last_name&quot;: &quot;Чорнопиский&quot;,
        &quot;email&quot;: &quot;c.chornopyskyi.ruslan@student.uzhnu.edu.ua&quot;,
        &quot;email_verified_at&quot;: &quot;2025-05-23T13:33:11.000000Z&quot;,
        &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
        &quot;role&quot;: &quot;user&quot;,
        &quot;biography&quot;: &quot;&lt;p&gt;&lt;strong&gt;Я крутий! Це редагування профілю!&lt;/strong&gt;&lt;/p&gt;&quot;,
        &quot;birthday&quot;: &quot;2025-05-15T00:00:00.000000Z&quot;,
        &quot;country&quot;: null,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;is_online&quot;: true,
        &quot;last_seen_at&quot;: &quot;2025-05-27T14:42:34.000000Z&quot;,
        &quot;is_blocked&quot;: false,
        &quot;created_at&quot;: &quot;2025-05-23T13:32:03.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-05-27T14:48:12.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--identifier-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--identifier-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--identifier-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--identifier-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--identifier-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--identifier-" data-method="GET"
      data-path="api/users/{identifier}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--identifier-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--identifier-"
                    onclick="tryItOut('GETapi-users--identifier-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--identifier-"
                    onclick="cancelTryOut('GETapi-users--identifier-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--identifier-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{identifier}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--identifier-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--identifier-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>identifier</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="identifier"                data-endpoint="GETapi-users--identifier-"
               value="9efaf65d-93c7-48dd-be37-cf8894bc225d"
               data-component="url">
    <br>
<p>Example: <code>9efaf65d-93c7-48dd-be37-cf8894bc225d</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-chats--chat_id--messages">GET api/chats/{chat_id}/messages</h2>

<p>
</p>



<span id="example-requests-GETapi-chats--chat_id--messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b/messages" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b/messages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-chats--chat_id--messages">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-chats--chat_id--messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-chats--chat_id--messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chats--chat_id--messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-chats--chat_id--messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chats--chat_id--messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-chats--chat_id--messages" data-method="GET"
      data-path="api/chats/{chat_id}/messages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-chats--chat_id--messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-chats--chat_id--messages"
                    onclick="tryItOut('GETapi-chats--chat_id--messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-chats--chat_id--messages"
                    onclick="cancelTryOut('GETapi-chats--chat_id--messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-chats--chat_id--messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/chats/{chat_id}/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-chats--chat_id--messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-chats--chat_id--messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>chat_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chat_id"                data-endpoint="GETapi-chats--chat_id--messages"
               value="9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
               data-component="url">
    <br>
<p>The ID of the chat. Example: <code>9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-messages">POST api/messages</h2>

<p>
</p>



<span id="example-requests-POSTapi-messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/messages" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "chat_id=architecto"\
    --form "content=n"\
    --form "attachments[]=@C:\Users\user1\AppData\Local\Temp\php7CD2.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/messages"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('chat_id', 'architecto');
body.append('content', 'n');
body.append('attachments[]', document.querySelector('input[name="attachments[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-messages">
</span>
<span id="execution-results-POSTapi-messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-messages" data-method="POST"
      data-path="api/messages"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-messages"
                    onclick="tryItOut('POSTapi-messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-messages"
                    onclick="cancelTryOut('POSTapi-messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-messages"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chat_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chat_id"                data-endpoint="POSTapi-messages"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the chats table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-messages"
               value="n"
               data-component="body">
    <br>
<p>This field is required when <code>attachments</code> is not present. Must not be greater than 360 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachments</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="attachments[0]"                data-endpoint="POSTapi-messages"
               data-component="body">
        <input type="file" style="display: none"
               name="attachments[1]"                data-endpoint="POSTapi-messages"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
Must be one of:
<ul style="list-style-type: square;"><li><code>jpg</code></li> <li><code>jpeg</code></li> <li><code>png</code></li> <li><code>gif</code></li> <li><code>webp</code></li> <li><code>mp4</code></li> <li><code>avi</code></li> <li><code>txt</code></li> <li><code>pdf</code></li> <li><code>doc</code></li> <li><code>docx</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-messages--id-">PUT api/messages/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-messages--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/messages/architecto" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "content=b"\
    --form "is_read=1"\
    --form "attachments[]=@C:\Users\user1\AppData\Local\Temp\php7CD3.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/messages/architecto"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('content', 'b');
body.append('is_read', '1');
body.append('attachments[]', document.querySelector('input[name="attachments[]"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-messages--id-">
</span>
<span id="execution-results-PUTapi-messages--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-messages--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-messages--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-messages--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-messages--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-messages--id-" data-method="PUT"
      data-path="api/messages/{id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-messages--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-messages--id-"
                    onclick="tryItOut('PUTapi-messages--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-messages--id-"
                    onclick="cancelTryOut('PUTapi-messages--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-messages--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/messages/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-messages--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-messages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-messages--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the message. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="PUTapi-messages--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 360 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachments</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="attachments[0]"                data-endpoint="PUTapi-messages--id-"
               data-component="body">
        <input type="file" style="display: none"
               name="attachments[1]"                data-endpoint="PUTapi-messages--id-"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
Must be one of:
<ul style="list-style-type: square;"><li><code>jpg</code></li> <li><code>jpeg</code></li> <li><code>png</code></li> <li><code>gif</code></li> <li><code>webp</code></li> <li><code>mp4</code></li> <li><code>avi</code></li> <li><code>txt</code></li> <li><code>pdf</code></li> <li><code>doc</code></li> <li><code>docx</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_read</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-messages--id-" style="display: none">
            <input type="radio" name="is_read"
                   value="true"
                   data-endpoint="PUTapi-messages--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-messages--id-" style="display: none">
            <input type="radio" name="is_read"
                   value="false"
                   data-endpoint="PUTapi-messages--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-messages--id-">DELETE api/messages/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-messages--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/messages/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/messages/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-messages--id-">
</span>
<span id="execution-results-DELETEapi-messages--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-messages--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-messages--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-messages--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-messages--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-messages--id-" data-method="DELETE"
      data-path="api/messages/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-messages--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-messages--id-"
                    onclick="tryItOut('DELETEapi-messages--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-messages--id-"
                    onclick="cancelTryOut('DELETEapi-messages--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-messages--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/messages/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-messages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-messages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-messages--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the message. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-friendships-send">Відправлення запиту на дружбу.</h2>

<p>
</p>



<span id="example-requests-POSTapi-friendships-send">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/friendships/send" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"sender_id\": \"architecto\",
    \"receiver_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/send"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "sender_id": "architecto",
    "receiver_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-friendships-send">
</span>
<span id="execution-results-POSTapi-friendships-send" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-friendships-send"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-friendships-send"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-friendships-send" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-friendships-send">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-friendships-send" data-method="POST"
      data-path="api/friendships/send"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-friendships-send', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-friendships-send"
                    onclick="tryItOut('POSTapi-friendships-send');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-friendships-send"
                    onclick="cancelTryOut('POSTapi-friendships-send');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-friendships-send"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/friendships/send</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-friendships-send"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-friendships-send"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sender_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sender_id"                data-endpoint="POSTapi-friendships-send"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_id"                data-endpoint="POSTapi-friendships-send"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-friendships--friendship_id--accept">Прийняття запиту на дружбу.</h2>

<p>
</p>



<span id="example-requests-PUTapi-friendships--friendship_id--accept">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/friendships/architecto/accept" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/architecto/accept"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-friendships--friendship_id--accept">
</span>
<span id="execution-results-PUTapi-friendships--friendship_id--accept" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-friendships--friendship_id--accept"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-friendships--friendship_id--accept"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-friendships--friendship_id--accept" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-friendships--friendship_id--accept">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-friendships--friendship_id--accept" data-method="PUT"
      data-path="api/friendships/{friendship_id}/accept"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-friendships--friendship_id--accept', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-friendships--friendship_id--accept"
                    onclick="tryItOut('PUTapi-friendships--friendship_id--accept');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-friendships--friendship_id--accept"
                    onclick="cancelTryOut('PUTapi-friendships--friendship_id--accept');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-friendships--friendship_id--accept"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/friendships/{friendship_id}/accept</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-friendships--friendship_id--accept"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-friendships--friendship_id--accept"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>friendship_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="friendship_id"                data-endpoint="PUTapi-friendships--friendship_id--accept"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the friendship. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-friendships--friendship_id--reject">Відхилення запиту на дружбу.</h2>

<p>
</p>



<span id="example-requests-PUTapi-friendships--friendship_id--reject">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/friendships/architecto/reject" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/architecto/reject"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-friendships--friendship_id--reject">
</span>
<span id="execution-results-PUTapi-friendships--friendship_id--reject" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-friendships--friendship_id--reject"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-friendships--friendship_id--reject"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-friendships--friendship_id--reject" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-friendships--friendship_id--reject">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-friendships--friendship_id--reject" data-method="PUT"
      data-path="api/friendships/{friendship_id}/reject"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-friendships--friendship_id--reject', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-friendships--friendship_id--reject"
                    onclick="tryItOut('PUTapi-friendships--friendship_id--reject');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-friendships--friendship_id--reject"
                    onclick="cancelTryOut('PUTapi-friendships--friendship_id--reject');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-friendships--friendship_id--reject"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/friendships/{friendship_id}/reject</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-friendships--friendship_id--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-friendships--friendship_id--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>friendship_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="friendship_id"                data-endpoint="PUTapi-friendships--friendship_id--reject"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the friendship. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-friendships--friendship_id--cancel">Скасування запиту на дружбу.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-friendships--friendship_id--cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/friendships/architecto/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/architecto/cancel"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-friendships--friendship_id--cancel">
</span>
<span id="execution-results-DELETEapi-friendships--friendship_id--cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-friendships--friendship_id--cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-friendships--friendship_id--cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-friendships--friendship_id--cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-friendships--friendship_id--cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-friendships--friendship_id--cancel" data-method="DELETE"
      data-path="api/friendships/{friendship_id}/cancel"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-friendships--friendship_id--cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-friendships--friendship_id--cancel"
                    onclick="tryItOut('DELETEapi-friendships--friendship_id--cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-friendships--friendship_id--cancel"
                    onclick="cancelTryOut('DELETEapi-friendships--friendship_id--cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-friendships--friendship_id--cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/friendships/{friendship_id}/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-friendships--friendship_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-friendships--friendship_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>friendship_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="friendship_id"                data-endpoint="DELETEapi-friendships--friendship_id--cancel"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the friendship. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-friendships--friendship_id--remove">Видалення друга.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-friendships--friendship_id--remove">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/friendships/architecto/remove" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/architecto/remove"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-friendships--friendship_id--remove">
</span>
<span id="execution-results-DELETEapi-friendships--friendship_id--remove" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-friendships--friendship_id--remove"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-friendships--friendship_id--remove"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-friendships--friendship_id--remove" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-friendships--friendship_id--remove">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-friendships--friendship_id--remove" data-method="DELETE"
      data-path="api/friendships/{friendship_id}/remove"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-friendships--friendship_id--remove', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-friendships--friendship_id--remove"
                    onclick="tryItOut('DELETEapi-friendships--friendship_id--remove');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-friendships--friendship_id--remove"
                    onclick="cancelTryOut('DELETEapi-friendships--friendship_id--remove');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-friendships--friendship_id--remove"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/friendships/{friendship_id}/remove</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-friendships--friendship_id--remove"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-friendships--friendship_id--remove"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>friendship_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="friendship_id"                data-endpoint="DELETEapi-friendships--friendship_id--remove"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the friendship. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-friendships--user_id--sent-requests">Отримання запитів на дружбу, що були надіслані.</h2>

<p>
</p>



<span id="example-requests-GETapi-friendships--user_id--sent-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/friendships/architecto/sent-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/architecto/sent-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-friendships--user_id--sent-requests">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-friendships--user_id--sent-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-friendships--user_id--sent-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-friendships--user_id--sent-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-friendships--user_id--sent-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-friendships--user_id--sent-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-friendships--user_id--sent-requests" data-method="GET"
      data-path="api/friendships/{user_id}/sent-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-friendships--user_id--sent-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-friendships--user_id--sent-requests"
                    onclick="tryItOut('GETapi-friendships--user_id--sent-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-friendships--user_id--sent-requests"
                    onclick="cancelTryOut('GETapi-friendships--user_id--sent-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-friendships--user_id--sent-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/friendships/{user_id}/sent-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-friendships--user_id--sent-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-friendships--user_id--sent-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="GETapi-friendships--user_id--sent-requests"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-friendships--user_id--received-requests">Отримання запитів на дружбу, що були отримані.</h2>

<p>
</p>



<span id="example-requests-GETapi-friendships--user_id--received-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/friendships/architecto/received-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/architecto/received-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-friendships--user_id--received-requests">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-friendships--user_id--received-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-friendships--user_id--received-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-friendships--user_id--received-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-friendships--user_id--received-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-friendships--user_id--received-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-friendships--user_id--received-requests" data-method="GET"
      data-path="api/friendships/{user_id}/received-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-friendships--user_id--received-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-friendships--user_id--received-requests"
                    onclick="tryItOut('GETapi-friendships--user_id--received-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-friendships--user_id--received-requests"
                    onclick="cancelTryOut('GETapi-friendships--user_id--received-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-friendships--user_id--received-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/friendships/{user_id}/received-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-friendships--user_id--received-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-friendships--user_id--received-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="GETapi-friendships--user_id--received-requests"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-friendships--user_id--friends">Отримання списку друзів.</h2>

<p>
</p>



<span id="example-requests-GETapi-friendships--user_id--friends">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/friendships/architecto/friends" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/friendships/architecto/friends"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-friendships--user_id--friends">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\User] architecto&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-friendships--user_id--friends" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-friendships--user_id--friends"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-friendships--user_id--friends"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-friendships--user_id--friends" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-friendships--user_id--friends">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-friendships--user_id--friends" data-method="GET"
      data-path="api/friendships/{user_id}/friends"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-friendships--user_id--friends', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-friendships--user_id--friends"
                    onclick="tryItOut('GETapi-friendships--user_id--friends');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-friendships--user_id--friends"
                    onclick="cancelTryOut('GETapi-friendships--user_id--friends');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-friendships--user_id--friends"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/friendships/{user_id}/friends</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-friendships--user_id--friends"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-friendships--user_id--friends"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="GETapi-friendships--user_id--friends"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-chats">GET api/chats</h2>

<p>
</p>



<span id="example-requests-GETapi-chats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/chats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/chats"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-chats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-chats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-chats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-chats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-chats" data-method="GET"
      data-path="api/chats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-chats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-chats"
                    onclick="tryItOut('GETapi-chats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-chats"
                    onclick="cancelTryOut('GETapi-chats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-chats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/chats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-chats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-chats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-chats">POST api/chats</h2>

<p>
</p>



<span id="example-requests-POSTapi-chats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/chats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"user_two_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/chats"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_two_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-chats">
</span>
<span id="execution-results-POSTapi-chats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-chats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-chats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-chats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-chats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-chats" data-method="POST"
      data-path="api/chats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-chats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-chats"
                    onclick="tryItOut('POSTapi-chats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-chats"
                    onclick="cancelTryOut('POSTapi-chats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-chats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/chats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-chats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-chats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_two_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_two_id"                data-endpoint="POSTapi-chats"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-chats--chat_id-">GET api/chats/{chat_id}</h2>

<p>
</p>



<span id="example-requests-GETapi-chats--chat_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-chats--chat_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-chats--chat_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-chats--chat_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chats--chat_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-chats--chat_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chats--chat_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-chats--chat_id-" data-method="GET"
      data-path="api/chats/{chat_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-chats--chat_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-chats--chat_id-"
                    onclick="tryItOut('GETapi-chats--chat_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-chats--chat_id-"
                    onclick="cancelTryOut('GETapi-chats--chat_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-chats--chat_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/chats/{chat_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-chats--chat_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-chats--chat_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>chat_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chat_id"                data-endpoint="GETapi-chats--chat_id-"
               value="9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
               data-component="url">
    <br>
<p>The ID of the chat. Example: <code>9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-chats--chat_id-">PUT api/chats/{chat_id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-chats--chat_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"last_message\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "last_message": "b"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-chats--chat_id-">
</span>
<span id="execution-results-PUTapi-chats--chat_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-chats--chat_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-chats--chat_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-chats--chat_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-chats--chat_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-chats--chat_id-" data-method="PUT"
      data-path="api/chats/{chat_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-chats--chat_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-chats--chat_id-"
                    onclick="tryItOut('PUTapi-chats--chat_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-chats--chat_id-"
                    onclick="cancelTryOut('PUTapi-chats--chat_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-chats--chat_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/chats/{chat_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-chats--chat_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-chats--chat_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>chat_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chat_id"                data-endpoint="PUTapi-chats--chat_id-"
               value="9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
               data-component="url">
    <br>
<p>The ID of the chat. Example: <code>9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_message"                data-endpoint="PUTapi-chats--chat_id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-chats--chat_id-">DELETE api/chats/{chat_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-chats--chat_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/chats/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-chats--chat_id-">
</span>
<span id="execution-results-DELETEapi-chats--chat_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-chats--chat_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-chats--chat_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-chats--chat_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-chats--chat_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-chats--chat_id-" data-method="DELETE"
      data-path="api/chats/{chat_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-chats--chat_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-chats--chat_id-"
                    onclick="tryItOut('DELETEapi-chats--chat_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-chats--chat_id-"
                    onclick="cancelTryOut('DELETEapi-chats--chat_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-chats--chat_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/chats/{chat_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-chats--chat_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-chats--chat_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>chat_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chat_id"                data-endpoint="DELETEapi-chats--chat_id-"
               value="9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
               data-component="url">
    <br>
<p>The ID of the chat. Example: <code>9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi--commentable_type---commentable--comments">Створює новий коментар для поста або фільму.</h2>

<p>
</p>



<span id="example-requests-POSTapi--commentable_type---commentable--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/architecto/architecto/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"content\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/architecto/architecto/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "content": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi--commentable_type---commentable--comments">
</span>
<span id="execution-results-POSTapi--commentable_type---commentable--comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi--commentable_type---commentable--comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi--commentable_type---commentable--comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi--commentable_type---commentable--comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi--commentable_type---commentable--comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi--commentable_type---commentable--comments" data-method="POST"
      data-path="api/{commentable_type}/{commentable}/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi--commentable_type---commentable--comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi--commentable_type---commentable--comments"
                    onclick="tryItOut('POSTapi--commentable_type---commentable--comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi--commentable_type---commentable--comments"
                    onclick="cancelTryOut('POSTapi--commentable_type---commentable--comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi--commentable_type---commentable--comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/{commentable_type}/{commentable}/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi--commentable_type---commentable--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi--commentable_type---commentable--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>commentable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commentable_type"                data-endpoint="POSTapi--commentable_type---commentable--comments"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>commentable</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commentable"                data-endpoint="POSTapi--commentable_type---commentable--comments"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="parent_id"                data-endpoint="POSTapi--commentable_type---commentable--comments"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the comments table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi--commentable_type---commentable--comments"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 256 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-comments--id-">Оновлює коментар.</h2>

<p>
</p>



<span id="example-requests-PUTapi-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"content\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "content": "b"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-comments--id-">
</span>
<span id="execution-results-PUTapi-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-comments--id-" data-method="PUT"
      data-path="api/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-comments--id-"
                    onclick="tryItOut('PUTapi-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-comments--id-"
                    onclick="cancelTryOut('PUTapi-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-comments--id-"
               value="9efbb164-672d-4615-ac85-4f62b4f5dd2d"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>9efbb164-672d-4615-ac85-4f62b4f5dd2d</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="PUTapi-comments--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 256 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-comments--id-">Видаляє коментар.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-comments--id-">
</span>
<span id="execution-results-DELETEapi-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-comments--id-" data-method="DELETE"
      data-path="api/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-comments--id-"
                    onclick="tryItOut('DELETEapi-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-comments--id-"
                    onclick="cancelTryOut('DELETEapi-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-comments--id-"
               value="9efbb164-672d-4615-ac85-4f62b4f5dd2d"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>9efbb164-672d-4615-ac85-4f62b4f5dd2d</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-user-comments">Отримує коментарі користувача.</h2>

<p>
</p>



<span id="example-requests-GETapi-user-comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user-comments">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user-comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user-comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user-comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user-comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user-comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user-comments" data-method="GET"
      data-path="api/user/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user-comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user-comments"
                    onclick="tryItOut('GETapi-user-comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user-comments"
                    onclick="cancelTryOut('GETapi-user-comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user-comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi--commentable_type---commentable--comments">Отримує список коментарів для поста або фільму.</h2>

<p>
</p>



<span id="example-requests-GETapi--commentable_type---commentable--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/architecto/architecto/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/architecto/architecto/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi--commentable_type---commentable--comments">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid commentable type&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi--commentable_type---commentable--comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi--commentable_type---commentable--comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi--commentable_type---commentable--comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi--commentable_type---commentable--comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi--commentable_type---commentable--comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi--commentable_type---commentable--comments" data-method="GET"
      data-path="api/{commentable_type}/{commentable}/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi--commentable_type---commentable--comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi--commentable_type---commentable--comments"
                    onclick="tryItOut('GETapi--commentable_type---commentable--comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi--commentable_type---commentable--comments"
                    onclick="cancelTryOut('GETapi--commentable_type---commentable--comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi--commentable_type---commentable--comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/{commentable_type}/{commentable}/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi--commentable_type---commentable--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi--commentable_type---commentable--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>commentable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commentable_type"                data-endpoint="GETapi--commentable_type---commentable--comments"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>commentable</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commentable"                data-endpoint="GETapi--commentable_type---commentable--comments"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-comments--id-">Отримує конкретний коментар по його ID.</h2>

<p>
</p>



<span id="example-requests-GETapi-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-comments--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: &quot;9efbb164-672d-4615-ac85-4f62b4f5dd2d&quot;,
    &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
    &quot;parent_id&quot;: null,
    &quot;commentable_type&quot;: &quot;App\\Models\\Post&quot;,
    &quot;commentable_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
    &quot;content&quot;: &quot;&lt;p&gt;Крутий пост! 100%!&lt;/p&gt;&quot;,
    &quot;likes_count&quot;: 0,
    &quot;created_at&quot;: &quot;2025-05-23T22:15:01.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-05-23T22:15:33.000000Z&quot;,
    &quot;replies_count&quot;: 2,
    &quot;user_liked&quot;: false,
    &quot;like_id&quot;: null,
    &quot;user&quot;: {
        &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
        &quot;username&quot;: &quot;Ruslan&quot;,
        &quot;first_name&quot;: &quot;Руслан&quot;,
        &quot;last_name&quot;: &quot;Чорнопиский&quot;,
        &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;
    },
    &quot;replies&quot;: [
        {
            &quot;id&quot;: &quot;9efbb1b3-cff6-4e17-9640-703e0249afba&quot;,
            &quot;user_id&quot;: &quot;9efaf921-f915-44c8-8c1d-679fb676be77&quot;,
            &quot;parent_id&quot;: &quot;9efbb164-672d-4615-ac85-4f62b4f5dd2d&quot;,
            &quot;commentable_type&quot;: &quot;App\\Models\\Post&quot;,
            &quot;commentable_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Згіден!&lt;/p&gt;&quot;,
            &quot;likes_count&quot;: 0,
            &quot;created_at&quot;: &quot;2025-05-23T22:15:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T22:15:53.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf921-f915-44c8-8c1d-679fb676be77&quot;,
                &quot;username&quot;: &quot;ruslancornopiskii&quot;,
                &quot;first_name&quot;: null,
                &quot;last_name&quot;: null,
                &quot;avatar&quot;: &quot;https://lh3.googleusercontent.com/a/ACg8ocIadrJhwkK91fuqsnD9s1c9e-EFEbpRPG8nBM200gnDwxzyfw=s96-c&quot;,
                &quot;is_online&quot;: true
            }
        },
        {
            &quot;id&quot;: &quot;9eff574b-3086-40da-b1fb-1bd70e07ac27&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;parent_id&quot;: &quot;9efbb164-672d-4615-ac85-4f62b4f5dd2d&quot;,
            &quot;commentable_type&quot;: &quot;App\\Models\\Post&quot;,
            &quot;commentable_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Так!&lt;/p&gt;&quot;,
            &quot;likes_count&quot;: 0,
            &quot;created_at&quot;: &quot;2025-05-25T17:46:23.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-25T17:46:23.000000Z&quot;,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;,
                &quot;is_online&quot;: true
            }
        }
    ],
    &quot;commentable&quot;: {
        &quot;id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
        &quot;title&quot;: &quot;Просто пост&quot;,
        &quot;content&quot;: &quot;&lt;p&gt;Крутий пост для тестування&lt;/p&gt;&quot;,
        &quot;user_id&quot;: &quot;9efba138-5629-4348-b52f-a4d72e576189&quot;,
        &quot;attachments&quot;: [
            &quot;attachments/41ab5d78-d034-4a94-bc2d-d0fdf7823249.webp&quot;
        ],
        &quot;slug&quot;: &quot;prosto-post&quot;,
        &quot;likes_count&quot;: 1,
        &quot;comments_count&quot;: 4,
        &quot;reports_count&quot;: 0,
        &quot;views_count&quot;: 3,
        &quot;comments_enabled&quot;: true,
        &quot;visibility&quot;: &quot;public&quot;,
        &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-05-25T17:46:23.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-comments--id-" data-method="GET"
      data-path="api/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-comments--id-"
                    onclick="tryItOut('GETapi-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-comments--id-"
                    onclick="cancelTryOut('GETapi-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-comments--id-"
               value="9efbb164-672d-4615-ac85-4f62b4f5dd2d"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>9efbb164-672d-4615-ac85-4f62b4f5dd2d</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-comments--comment_id--replies">Отримує відповіді на коментар.</h2>

<p>
</p>



<span id="example-requests-GETapi-comments--comment_id--replies">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d/replies" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d/replies"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-comments--comment_id--replies">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;9efbb1b3-cff6-4e17-9640-703e0249afba&quot;,
            &quot;user_id&quot;: &quot;9efaf921-f915-44c8-8c1d-679fb676be77&quot;,
            &quot;parent_id&quot;: &quot;9efbb164-672d-4615-ac85-4f62b4f5dd2d&quot;,
            &quot;commentable_type&quot;: &quot;App\\Models\\Post&quot;,
            &quot;commentable_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Згіден!&lt;/p&gt;&quot;,
            &quot;likes_count&quot;: 0,
            &quot;created_at&quot;: &quot;2025-05-23T22:15:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T22:15:53.000000Z&quot;,
            &quot;replies_count&quot;: 1,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf921-f915-44c8-8c1d-679fb676be77&quot;,
                &quot;username&quot;: &quot;ruslancornopiskii&quot;,
                &quot;first_name&quot;: null,
                &quot;last_name&quot;: null,
                &quot;avatar&quot;: &quot;https://lh3.googleusercontent.com/a/ACg8ocIadrJhwkK91fuqsnD9s1c9e-EFEbpRPG8nBM200gnDwxzyfw=s96-c&quot;
            }
        },
        {
            &quot;id&quot;: &quot;9eff574b-3086-40da-b1fb-1bd70e07ac27&quot;,
            &quot;user_id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
            &quot;parent_id&quot;: &quot;9efbb164-672d-4615-ac85-4f62b4f5dd2d&quot;,
            &quot;commentable_type&quot;: &quot;App\\Models\\Post&quot;,
            &quot;commentable_id&quot;: &quot;9efba248-77c1-4133-b827-cc5491290705&quot;,
            &quot;content&quot;: &quot;&lt;p&gt;Так!&lt;/p&gt;&quot;,
            &quot;likes_count&quot;: 0,
            &quot;created_at&quot;: &quot;2025-05-25T17:46:23.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-25T17:46:23.000000Z&quot;,
            &quot;replies_count&quot;: 0,
            &quot;user_liked&quot;: false,
            &quot;like_id&quot;: null,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
                &quot;username&quot;: &quot;Ruslan&quot;,
                &quot;first_name&quot;: &quot;Руслан&quot;,
                &quot;last_name&quot;: &quot;Чорнопиский&quot;,
                &quot;avatar&quot;: &quot;/storage/avatars/96721f0d-f470-4259-a0f4-2e43d4a4174b.webp&quot;
            }
        }
    ],
    &quot;path&quot;: &quot;http://localhost:8000/api/comments/9efbb164-672d-4615-ac85-4f62b4f5dd2d/replies&quot;,
    &quot;per_page&quot;: 20,
    &quot;next_cursor&quot;: null,
    &quot;next_page_url&quot;: null,
    &quot;prev_cursor&quot;: null,
    &quot;prev_page_url&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-comments--comment_id--replies" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-comments--comment_id--replies"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-comments--comment_id--replies"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-comments--comment_id--replies" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-comments--comment_id--replies">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-comments--comment_id--replies" data-method="GET"
      data-path="api/comments/{comment_id}/replies"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-comments--comment_id--replies', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-comments--comment_id--replies"
                    onclick="tryItOut('GETapi-comments--comment_id--replies');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-comments--comment_id--replies"
                    onclick="cancelTryOut('GETapi-comments--comment_id--replies');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-comments--comment_id--replies"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/comments/{comment_id}/replies</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-comments--comment_id--replies"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-comments--comment_id--replies"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>comment_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment_id"                data-endpoint="GETapi-comments--comment_id--replies"
               value="9efbb164-672d-4615-ac85-4f62b4f5dd2d"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>9efbb164-672d-4615-ac85-4f62b4f5dd2d</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-reports">GET api/reports</h2>

<p>
</p>



<span id="example-requests-GETapi-reports">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/reports" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/reports"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-reports">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-reports" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-reports"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-reports"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-reports" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-reports">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-reports" data-method="GET"
      data-path="api/reports"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-reports', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-reports"
                    onclick="tryItOut('GETapi-reports');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-reports"
                    onclick="cancelTryOut('GETapi-reports');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-reports"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/reports</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-reports">POST api/reports</h2>

<p>
</p>



<span id="example-requests-POSTapi-reports">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/reports" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"post_id\": \"architecto\",
    \"reason\": \"Misleading\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/reports"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "post_id": "architecto",
    "reason": "Misleading"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-reports">
</span>
<span id="execution-results-POSTapi-reports" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-reports"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-reports"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-reports" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-reports">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-reports" data-method="POST"
      data-path="api/reports"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-reports', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-reports"
                    onclick="tryItOut('POSTapi-reports');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-reports"
                    onclick="cancelTryOut('POSTapi-reports');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-reports"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/reports</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>post_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="post_id"                data-endpoint="POSTapi-reports"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the posts table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-reports"
               value="Misleading"
               data-component="body">
    <br>
<p>Example: <code>Misleading</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Spam</code></li> <li><code>Copyright</code></li> <li><code>Offensive_content</code></li> <li><code>Misleading</code></li> <li><code>Other</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-reports--report_id-">DELETE api/reports/{report_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-reports--report_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/reports/9eff49c8-7c61-47cd-b817-465360bf94aa" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/reports/9eff49c8-7c61-47cd-b817-465360bf94aa"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-reports--report_id-">
</span>
<span id="execution-results-DELETEapi-reports--report_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-reports--report_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-reports--report_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-reports--report_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-reports--report_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-reports--report_id-" data-method="DELETE"
      data-path="api/reports/{report_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-reports--report_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-reports--report_id-"
                    onclick="tryItOut('DELETEapi-reports--report_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-reports--report_id-"
                    onclick="cancelTryOut('DELETEapi-reports--report_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-reports--report_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/reports/{report_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-reports--report_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-reports--report_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>report_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="report_id"                data-endpoint="DELETEapi-reports--report_id-"
               value="9eff49c8-7c61-47cd-b817-465360bf94aa"
               data-component="url">
    <br>
<p>The ID of the report. Example: <code>9eff49c8-7c61-47cd-b817-465360bf94aa</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-post-views">Отримати список переглядів постів користувача.</h2>

<p>
</p>



<span id="example-requests-GETapi-post-views">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/post-views" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/post-views"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-post-views">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-post-views" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-post-views"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-post-views"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-post-views" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-post-views">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-post-views" data-method="GET"
      data-path="api/post-views"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-post-views', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-post-views"
                    onclick="tryItOut('GETapi-post-views');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-post-views"
                    onclick="cancelTryOut('GETapi-post-views');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-post-views"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/post-views</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-post-views"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-post-views"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-tags">GET api/tags</h2>

<p>
</p>



<span id="example-requests-GETapi-tags">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/tags" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tags"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tags">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;9efba248-97c6-4110-b434-adc18070d706&quot;,
            &quot;name&quot;: &quot;tech&quot;,
            &quot;slug&quot;: &quot;tech-tech&quot;,
            &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
            &quot;posts_count&quot;: 2
        },
        {
            &quot;id&quot;: &quot;9efba248-98bd-41cb-af86-5e7403850f71&quot;,
            &quot;name&quot;: &quot;science&quot;,
            &quot;slug&quot;: &quot;science-science&quot;,
            &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
            &quot;posts_count&quot;: 5
        },
        {
            &quot;id&quot;: &quot;9efba248-9987-4557-a0ee-1c64f1ec85ca&quot;,
            &quot;name&quot;: &quot;coding&quot;,
            &quot;slug&quot;: &quot;coding-coding&quot;,
            &quot;created_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-23T21:32:46.000000Z&quot;,
            &quot;posts_count&quot;: 5
        },
        {
            &quot;id&quot;: &quot;9efd1d77-9244-46d4-9cbe-3b9305077aba&quot;,
            &quot;name&quot;: &quot;news&quot;,
            &quot;slug&quot;: &quot;news-news&quot;,
            &quot;created_at&quot;: &quot;2025-05-24T15:13:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-24T15:13:02.000000Z&quot;,
            &quot;posts_count&quot;: 2
        },
        {
            &quot;id&quot;: &quot;9eff51e5-5c44-4bc9-a77c-ef3bf020457f&quot;,
            &quot;name&quot;: &quot;sports&quot;,
            &quot;slug&quot;: &quot;sports-sports&quot;,
            &quot;created_at&quot;: &quot;2025-05-25T17:31:18.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-25T17:31:18.000000Z&quot;,
            &quot;posts_count&quot;: 1
        },
        {
            &quot;id&quot;: &quot;9f0300e8-0cef-44b8-9312-8446858a8b3c&quot;,
            &quot;name&quot;: &quot;аніме&quot;,
            &quot;slug&quot;: &quot;anime-anime&quot;,
            &quot;created_at&quot;: &quot;2025-05-27T13:28:09.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-05-27T13:28:09.000000Z&quot;,
            &quot;posts_count&quot;: 1
        }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost:8000/api/tags?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;last_page_url&quot;: &quot;http://localhost:8000/api/tags?page=1&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost:8000/api/tags?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;active&quot;: true
        },
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
            &quot;active&quot;: false
        }
    ],
    &quot;next_page_url&quot;: null,
    &quot;path&quot;: &quot;http://localhost:8000/api/tags&quot;,
    &quot;per_page&quot;: 20,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 6,
    &quot;total&quot;: 6
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tags" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tags"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tags"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tags">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tags" data-method="GET"
      data-path="api/tags"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tags', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tags"
                    onclick="tryItOut('GETapi-tags');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tags"
                    onclick="cancelTryOut('GETapi-tags');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tags"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tags</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-user-blocks">GET api/user-blocks</h2>

<p>
</p>



<span id="example-requests-GETapi-user-blocks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user-blocks" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user-blocks"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user-blocks">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user-blocks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user-blocks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user-blocks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user-blocks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user-blocks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user-blocks" data-method="GET"
      data-path="api/user-blocks"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user-blocks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user-blocks"
                    onclick="tryItOut('GETapi-user-blocks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user-blocks"
                    onclick="cancelTryOut('GETapi-user-blocks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user-blocks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user-blocks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user-blocks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user-blocks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-user-blocks">POST api/user-blocks</h2>

<p>
</p>



<span id="example-requests-POSTapi-user-blocks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user-blocks" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"blocked_id\": \"architecto\",
    \"reason\": \"Harassment\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user-blocks"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "blocked_id": "architecto",
    "reason": "Harassment"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-user-blocks">
</span>
<span id="execution-results-POSTapi-user-blocks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user-blocks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-blocks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user-blocks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-blocks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user-blocks" data-method="POST"
      data-path="api/user-blocks"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-blocks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user-blocks"
                    onclick="tryItOut('POSTapi-user-blocks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user-blocks"
                    onclick="cancelTryOut('POSTapi-user-blocks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user-blocks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user-blocks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-user-blocks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-user-blocks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blocked_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="blocked_id"                data-endpoint="POSTapi-user-blocks"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-user-blocks"
               value="Harassment"
               data-component="body">
    <br>
<p>Example: <code>Harassment</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Spam</code></li> <li><code>Harassment</code></li> <li><code>Offensive Content</code></li> <li><code>Other</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-user-blocks--userBlock_id-">DELETE api/user-blocks/{userBlock_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-user-blocks--userBlock_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/user-blocks/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user-blocks/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-user-blocks--userBlock_id-">
</span>
<span id="execution-results-DELETEapi-user-blocks--userBlock_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-user-blocks--userBlock_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-user-blocks--userBlock_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-user-blocks--userBlock_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-user-blocks--userBlock_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-user-blocks--userBlock_id-" data-method="DELETE"
      data-path="api/user-blocks/{userBlock_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-user-blocks--userBlock_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-user-blocks--userBlock_id-"
                    onclick="tryItOut('DELETEapi-user-blocks--userBlock_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-user-blocks--userBlock_id-"
                    onclick="cancelTryOut('DELETEapi-user-blocks--userBlock_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-user-blocks--userBlock_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/user-blocks/{userBlock_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-user-blocks--userBlock_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-user-blocks--userBlock_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userBlock_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="userBlock_id"                data-endpoint="DELETEapi-user-blocks--userBlock_id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the userBlock. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-user-status-online">POST api/user/status/online</h2>

<p>
</p>



<span id="example-requests-POSTapi-user-status-online">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user/status/online" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/status/online"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-user-status-online">
</span>
<span id="execution-results-POSTapi-user-status-online" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user-status-online"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-status-online"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user-status-online" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-status-online">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user-status-online" data-method="POST"
      data-path="api/user/status/online"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-status-online', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user-status-online"
                    onclick="tryItOut('POSTapi-user-status-online');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user-status-online"
                    onclick="cancelTryOut('POSTapi-user-status-online');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user-status-online"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user/status/online</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-user-status-online"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-user-status-online"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-user-status-offline">POST api/user/status/offline</h2>

<p>
</p>



<span id="example-requests-POSTapi-user-status-offline">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user/status/offline" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/status/offline"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-user-status-offline">
</span>
<span id="execution-results-POSTapi-user-status-offline" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user-status-offline"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-status-offline"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user-status-offline" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-status-offline">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user-status-offline" data-method="POST"
      data-path="api/user/status/offline"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-status-offline', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user-status-offline"
                    onclick="tryItOut('POSTapi-user-status-offline');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user-status-offline"
                    onclick="cancelTryOut('POSTapi-user-status-offline');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user-status-offline"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user/status/offline</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-user-status-offline"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-user-status-offline"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-user-status-online-ids">GET api/user/status/online-ids</h2>

<p>
</p>



<span id="example-requests-GETapi-user-status-online-ids">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user/status/online-ids" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/status/online-ids"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user-status-online-ids">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    &quot;9efaf65d-93c7-48dd-be37-cf8894bc225d&quot;,
    &quot;9efaf921-f915-44c8-8c1d-679fb676be77&quot;
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user-status-online-ids" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user-status-online-ids"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user-status-online-ids"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user-status-online-ids" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user-status-online-ids">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user-status-online-ids" data-method="GET"
      data-path="api/user/status/online-ids"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user-status-online-ids', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user-status-online-ids"
                    onclick="tryItOut('GETapi-user-status-online-ids');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user-status-online-ids"
                    onclick="cancelTryOut('GETapi-user-status-online-ids');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user-status-online-ids"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user/status/online-ids</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user-status-online-ids"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user-status-online-ids"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi--likeable_type---likeable--likes">Додає лайк до поста, фільму або коментаря.</h2>

<p>
</p>



<span id="example-requests-POSTapi--likeable_type---likeable--likes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/architecto/architecto/likes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/architecto/architecto/likes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi--likeable_type---likeable--likes">
</span>
<span id="execution-results-POSTapi--likeable_type---likeable--likes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi--likeable_type---likeable--likes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi--likeable_type---likeable--likes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi--likeable_type---likeable--likes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi--likeable_type---likeable--likes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi--likeable_type---likeable--likes" data-method="POST"
      data-path="api/{likeable_type}/{likeable}/likes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi--likeable_type---likeable--likes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi--likeable_type---likeable--likes"
                    onclick="tryItOut('POSTapi--likeable_type---likeable--likes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi--likeable_type---likeable--likes"
                    onclick="cancelTryOut('POSTapi--likeable_type---likeable--likes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi--likeable_type---likeable--likes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/{likeable_type}/{likeable}/likes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi--likeable_type---likeable--likes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi--likeable_type---likeable--likes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>likeable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="likeable_type"                data-endpoint="POSTapi--likeable_type---likeable--likes"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>likeable</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="likeable"                data-endpoint="POSTapi--likeable_type---likeable--likes"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-likes--like_id-">Видаляє лайк.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-likes--like_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/likes/9efba2b4-4411-4acd-b89f-b98393a54502" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/likes/9efba2b4-4411-4acd-b89f-b98393a54502"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-likes--like_id-">
</span>
<span id="execution-results-DELETEapi-likes--like_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-likes--like_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-likes--like_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-likes--like_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-likes--like_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-likes--like_id-" data-method="DELETE"
      data-path="api/likes/{like_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-likes--like_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-likes--like_id-"
                    onclick="tryItOut('DELETEapi-likes--like_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-likes--like_id-"
                    onclick="cancelTryOut('DELETEapi-likes--like_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-likes--like_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/likes/{like_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-likes--like_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-likes--like_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>like_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="like_id"                data-endpoint="DELETEapi-likes--like_id-"
               value="9efba2b4-4411-4acd-b89f-b98393a54502"
               data-component="url">
    <br>
<p>The ID of the like. Example: <code>9efba2b4-4411-4acd-b89f-b98393a54502</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-user-likes">GET api/user/likes</h2>

<p>
</p>



<span id="example-requests-GETapi-user-likes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user/likes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/likes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user-likes">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user-likes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user-likes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user-likes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user-likes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user-likes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user-likes" data-method="GET"
      data-path="api/user/likes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user-likes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user-likes"
                    onclick="tryItOut('GETapi-user-likes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user-likes"
                    onclick="cancelTryOut('GETapi-user-likes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user-likes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user/likes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user-likes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user-likes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-notifications">Отримати всі нотифікації користувача</h2>

<p>
</p>



<span id="example-requests-GETapi-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/notifications" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/notifications"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-notifications">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-notifications" data-method="GET"
      data-path="api/notifications"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-notifications"
                    onclick="tryItOut('GETapi-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-notifications"
                    onclick="cancelTryOut('GETapi-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-notifications-mark-as-read">Позначити всі нотифікації як прочитані</h2>

<p>
</p>



<span id="example-requests-POSTapi-notifications-mark-as-read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/notifications/mark-as-read" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/notifications/mark-as-read"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-notifications-mark-as-read">
</span>
<span id="execution-results-POSTapi-notifications-mark-as-read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-notifications-mark-as-read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-notifications-mark-as-read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-notifications-mark-as-read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-notifications-mark-as-read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-notifications-mark-as-read" data-method="POST"
      data-path="api/notifications/mark-as-read"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-notifications-mark-as-read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-notifications-mark-as-read"
                    onclick="tryItOut('POSTapi-notifications-mark-as-read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-notifications-mark-as-read"
                    onclick="cancelTryOut('POSTapi-notifications-mark-as-read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-notifications-mark-as-read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/notifications/mark-as-read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-notifications-mark-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-notifications-mark-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-notifications--notificationId--mark-as-read">Позначити одну нотифікацію як прочитану</h2>

<p>
</p>



<span id="example-requests-POSTapi-notifications--notificationId--mark-as-read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/notifications/architecto/mark-as-read" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/notifications/architecto/mark-as-read"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-notifications--notificationId--mark-as-read">
</span>
<span id="execution-results-POSTapi-notifications--notificationId--mark-as-read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-notifications--notificationId--mark-as-read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-notifications--notificationId--mark-as-read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-notifications--notificationId--mark-as-read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-notifications--notificationId--mark-as-read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-notifications--notificationId--mark-as-read" data-method="POST"
      data-path="api/notifications/{notificationId}/mark-as-read"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-notifications--notificationId--mark-as-read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-notifications--notificationId--mark-as-read"
                    onclick="tryItOut('POSTapi-notifications--notificationId--mark-as-read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-notifications--notificationId--mark-as-read"
                    onclick="cancelTryOut('POSTapi-notifications--notificationId--mark-as-read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-notifications--notificationId--mark-as-read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/notifications/{notificationId}/mark-as-read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-notifications--notificationId--mark-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-notifications--notificationId--mark-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>notificationId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notificationId"                data-endpoint="POSTapi-notifications--notificationId--mark-as-read"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-notifications--notificationId-">Видалити одну нотифікацію</h2>

<p>
</p>



<span id="example-requests-DELETEapi-notifications--notificationId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/notifications/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/notifications/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-notifications--notificationId-">
</span>
<span id="execution-results-DELETEapi-notifications--notificationId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-notifications--notificationId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-notifications--notificationId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-notifications--notificationId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-notifications--notificationId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-notifications--notificationId-" data-method="DELETE"
      data-path="api/notifications/{notificationId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-notifications--notificationId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-notifications--notificationId-"
                    onclick="tryItOut('DELETEapi-notifications--notificationId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-notifications--notificationId-"
                    onclick="cancelTryOut('DELETEapi-notifications--notificationId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-notifications--notificationId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/notifications/{notificationId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-notifications--notificationId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-notifications--notificationId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>notificationId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notificationId"                data-endpoint="DELETEapi-notifications--notificationId-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-settings">Get the authenticated user&#039;s settings.</h2>

<p>
</p>



<span id="example-requests-GETapi-settings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/settings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/settings"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-settings">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-settings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-settings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-settings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-settings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-settings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-settings" data-method="GET"
      data-path="api/settings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-settings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-settings"
                    onclick="tryItOut('GETapi-settings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-settings"
                    onclick="cancelTryOut('GETapi-settings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-settings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/settings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-settings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-settings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-settings-notifications">Update notification setting.</h2>

<p>
</p>



<span id="example-requests-POSTapi-settings-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/settings/notifications" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"type\": \"comment_reply\",
    \"enabled\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/settings/notifications"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "comment_reply",
    "enabled": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-settings-notifications">
</span>
<span id="execution-results-POSTapi-settings-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-settings-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-settings-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-settings-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-settings-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-settings-notifications" data-method="POST"
      data-path="api/settings/notifications"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-settings-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-settings-notifications"
                    onclick="tryItOut('POSTapi-settings-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-settings-notifications"
                    onclick="cancelTryOut('POSTapi-settings-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-settings-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/settings/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-settings-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-settings-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-settings-notifications"
               value="comment_reply"
               data-component="body">
    <br>
<p>Example: <code>comment_reply</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>friend_request</code></li> <li><code>new_message</code></li> <li><code>post_comment</code></li> <li><code>post_like</code></li> <li><code>comment_reply</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>enabled</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-settings-notifications" style="display: none">
            <input type="radio" name="enabled"
                   value="true"
                   data-endpoint="POSTapi-settings-notifications"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-settings-notifications" style="display: none">
            <input type="radio" name="enabled"
                   value="false"
                   data-endpoint="POSTapi-settings-notifications"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-settings-message-privacy">Update message privacy setting.</h2>

<p>
</p>



<span id="example-requests-POSTapi-settings-message-privacy">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/settings/message-privacy" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"privacy\": \"no_one\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/settings/message-privacy"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "privacy": "no_one"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-settings-message-privacy">
</span>
<span id="execution-results-POSTapi-settings-message-privacy" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-settings-message-privacy"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-settings-message-privacy"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-settings-message-privacy" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-settings-message-privacy">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-settings-message-privacy" data-method="POST"
      data-path="api/settings/message-privacy"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-settings-message-privacy', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-settings-message-privacy"
                    onclick="tryItOut('POSTapi-settings-message-privacy');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-settings-message-privacy"
                    onclick="cancelTryOut('POSTapi-settings-message-privacy');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-settings-message-privacy"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/settings/message-privacy</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-settings-message-privacy"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-settings-message-privacy"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>privacy</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="privacy"                data-endpoint="POSTapi-settings-message-privacy"
               value="no_one"
               data-component="body">
    <br>
<p>Example: <code>no_one</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>everyone</code></li> <li><code>friends_only</code></li> <li><code>no_one</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-settings-friend-request-privacy">Update friend request privacy setting.</h2>

<p>
</p>



<span id="example-requests-POSTapi-settings-friend-request-privacy">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/settings/friend-request-privacy" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"privacy\": \"everyone\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/settings/friend-request-privacy"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "privacy": "everyone"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-settings-friend-request-privacy">
</span>
<span id="execution-results-POSTapi-settings-friend-request-privacy" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-settings-friend-request-privacy"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-settings-friend-request-privacy"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-settings-friend-request-privacy" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-settings-friend-request-privacy">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-settings-friend-request-privacy" data-method="POST"
      data-path="api/settings/friend-request-privacy"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-settings-friend-request-privacy', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-settings-friend-request-privacy"
                    onclick="tryItOut('POSTapi-settings-friend-request-privacy');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-settings-friend-request-privacy"
                    onclick="cancelTryOut('POSTapi-settings-friend-request-privacy');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-settings-friend-request-privacy"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/settings/friend-request-privacy</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-settings-friend-request-privacy"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-settings-friend-request-privacy"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>privacy</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="privacy"                data-endpoint="POSTapi-settings-friend-request-privacy"
               value="everyone"
               data-component="body">
    <br>
<p>Example: <code>everyone</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>everyone</code></li> <li><code>no_one</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-storage-private-post--directory---fileName-">Віддає файл, прикріплений до поста, якщо користувач має доступ.</h2>

<p>
</p>



<span id="example-requests-GETapi-storage-private-post--directory---fileName-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/storage/private/post/9efba248-77c1-4133-b827-cc5491290705/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/storage/private/post/9efba248-77c1-4133-b827-cc5491290705/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-storage-private-post--directory---fileName-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-storage-private-post--directory---fileName-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-storage-private-post--directory---fileName-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-storage-private-post--directory---fileName-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-storage-private-post--directory---fileName-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-storage-private-post--directory---fileName-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-storage-private-post--directory---fileName-" data-method="GET"
      data-path="api/storage/private/post/{directory}/{fileName}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-storage-private-post--directory---fileName-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-storage-private-post--directory---fileName-"
                    onclick="tryItOut('GETapi-storage-private-post--directory---fileName-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-storage-private-post--directory---fileName-"
                    onclick="cancelTryOut('GETapi-storage-private-post--directory---fileName-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-storage-private-post--directory---fileName-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/storage/private/post/{directory}/{fileName}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-storage-private-post--directory---fileName-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-storage-private-post--directory---fileName-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>directory</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="directory"                data-endpoint="GETapi-storage-private-post--directory---fileName-"
               value="9efba248-77c1-4133-b827-cc5491290705"
               data-component="url">
    <br>
<p>Example: <code>9efba248-77c1-4133-b827-cc5491290705</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fileName</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="fileName"                data-endpoint="GETapi-storage-private-post--directory---fileName-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-storage-private-chat--directory---fileName-">Віддає файл, прикріплений до повідомлення в чаті, якщо користувач є учасником чату.</h2>

<p>
</p>



<span id="example-requests-GETapi-storage-private-chat--directory---fileName-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/storage/private/chat/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/storage/private/chat/9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-storage-private-chat--directory---fileName-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-storage-private-chat--directory---fileName-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-storage-private-chat--directory---fileName-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-storage-private-chat--directory---fileName-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-storage-private-chat--directory---fileName-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-storage-private-chat--directory---fileName-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-storage-private-chat--directory---fileName-" data-method="GET"
      data-path="api/storage/private/chat/{directory}/{fileName}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-storage-private-chat--directory---fileName-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-storage-private-chat--directory---fileName-"
                    onclick="tryItOut('GETapi-storage-private-chat--directory---fileName-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-storage-private-chat--directory---fileName-"
                    onclick="cancelTryOut('GETapi-storage-private-chat--directory---fileName-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-storage-private-chat--directory---fileName-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/storage/private/chat/{directory}/{fileName}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-storage-private-chat--directory---fileName-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-storage-private-chat--directory---fileName-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>directory</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="directory"                data-endpoint="GETapi-storage-private-chat--directory---fileName-"
               value="9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b"
               data-component="url">
    <br>
<p>Example: <code>9f03e0f4-4b99-4ecb-a07d-8ab916d3ed4b</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fileName</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="fileName"                data-endpoint="GETapi-storage-private-chat--directory---fileName-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
