

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-weight: 500;
            font-family: Arial, sans-serif;
        }
        .btn {margin: 10px 0px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff !important;
            height: 46px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            background-image: linear-gradient(to right top, #021d68, #052579, #072d8b, #09369d, #093fb0) !important;
        }
        .btn:hover {
            text-decoration: none;
            opacity: .8;
        }
    </style>
</head>
<body style="margin:0;padding:0;">
<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #F2F4F6; margin: 0; padding: 0;" bgcolor="#F2F4F6">
      <tr>
        <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 0;">
            <tr>
              <td class="email-masthead" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: center; padding: 25px 0;" align="center">
              </td>
            </tr>
            <!-- Email Body -->
            <tr>
              <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="word-break: break-word; margin: 0; padding: 0; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #FFFFFF; margin: 0 auto; padding: 0;" bgcolor="#FFFFFF">
                  <!-- Body content -->
                  <tr>
                    <td class="content-cell" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 45px;">
                      <div class="f-fallback">
                        <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Seventh-Day Adventist Church</h1>
                        <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">{!! $body !!}</p>
                        <!-- Action -->
                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 30px auto; padding: 0;">
                          <tr>
                            <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                              <!-- Border based button
           https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                <tr>
                                  <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                    <a target="_blank" href="{{ $action_link }}" class="f-fallback button button--green" target="_blank" style="color: #FFF; border-color: #22bc66; border-style: solid; border-width: 10px 18px; background-color: #22BC66; display: inline-block; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">Reset your password</a>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                        
                        <!-- Sub copy -->
                        <table class="body-sub" role="presentation" style="margin-top: 25px; padding-top: 25px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                          <tr>
                            <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                              <p class="f-fallback sub" style="font-size: 13px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                              <p class="f-fallback sub" style="font-size: 13px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">{!! $action_link !!}</p>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 0 auto; padding: 0;">
                  <tr>
                    <td class="content-cell" align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 45px;">
                      <p class="f-fallback sub align-center" style="font-size: 13px; line-height: 1.625; text-align: center; color: #A8AAAF; margin: .4em 0 1.1875em;" align="center">©
                      <script>
                        document.write(new Date().getFullYear())
                      </script> Obando Seventh-Day Adventist Church. All rights reserved.</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    
</body>
</html>

