<?php ?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>Admin Page</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    </head>
    <body class="bg-gradient-light">
        <div class="container">
            <!-- Main -->
            <div id="main">
                <div class="inner">
                    <!-- Header -->
                    <header id="header">
                        <strong>ADMIN ACCOUNT PAGE</strong>
                    </header>
                    <section id="banner">
                        <div class="content">
                            <div class="col-6 col-12-xsmall">
                                <form method="POST" enctype="multipart/form-data">
                                    <h3>관리자 계정 추가</h3>
                                    <table class="intro">
                                        <tr>
                                            <td>아이디</td>
                                            <td colspan="3"><input type="text" name="id" value="<?= $account_data['id'] ?? "" ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td>비밀번호</td>
                                            <td colspan="3"><input type="password" name="pw" value="<?= $account_data['pw'] ?? ""?>"></td>
                                        </tr>
                                    </table>
                                    <p style="text-align:center"><input type="submit" value="등록"></p>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
