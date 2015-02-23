<div id="returnmessage"><p></p></div>
<form action="Javascript/reg.js" method="POST" enctype="multipart/form-data" name="RegisterForm" id="RegisterForm">
        <table class="TableStyleBig center WidthAuto">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table class="TableStyleRegUp center WidthAuto">
              <tr>
                <td><table >
                  <tr class="updateLayout">
                    <td ><label for="FirstName">
                      <h6>First Name <span class="required">*</span> :</h6>
                      <br>
                      </label>
                      <input name="FirstName" type="text" required="required" class="styletxtfield" id="FirstName"></td>
                    <td><label for="LastName">
                      <h6>Last Name:</h6>
                      <br>
                      </label>
                      <input name="LastName" type="text" class="styletxtfield" id="LastName"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="Email">
                  <h6>Email <span class="required">*</span> :</h6>
                  <br>
                  </label>
                  <input name="Email" type="email" required="required" class="styletxtfield" id="Email"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0">
                  <tr class="updateLayout">
                    <td><label for="Password">
                      <h6>Password <span class="required">*</span> :</h6>
                      </label>
                      <input name="Password" type="password" required="required" class="styletxtfield" id="Password"></td>
                    <td><label for="PasswordConfirm">
                      <h6>Confirm Password <span class="required">*</span> :</h6>
                      </label>
                      <input name="PasswordConfirm" type="password" required="required" class="styletxtfield" id="PasswordConfirm"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="Language">
                  <h6>Language <span class="required">*</span> :</h6>
                  <br>
                  </label>
                  <input name="Language" type="text" required="required" class="styletxtfield" id="Language"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="Url">
                  <h6>URL <span class="required">*</span> :</h6>
                  <br>
                  </label>
                  <input name="Url" type="text" required="required" class="styletxtfield" id="Url"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="Title">
                  <h6>Title <span class="required">*</span> :</h6>
                  <br>
                  </label>
                  <input name="Title" type="text" required="required" class="styletxtfield" id="Title"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="Description">
                  <h6>Description <span class="required">*</span> :</h6>
                  <br>
                  </label>
                  <textarea name="Description" required class="styletxtarea" id="Description"></textarea></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="PreviewPicture">
                  <h6>Preview Picture :</h6>
                  <br>
                  </label>
                  <input name="PreviewPicture" type="file" id="PreviewPicture" title="PreviewPicture"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="submit" name="RegisterButton" id="RegisterButton" value="Register"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="RegisterForm">
      </form>