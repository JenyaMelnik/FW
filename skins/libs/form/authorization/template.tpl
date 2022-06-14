<form action="" method="POST" class="form-authorization" enctype="multipart/form-data"><table>
    <tr<?php if(!empty($this->content['login']['error'])) {echo ' style="background-color:#FAA"';} ?>>
      <td><?php echo $this->content['login']['title']; ?></td>
      <td>
        <input type="<?php echo $this->content['login']['type']; ?>" name="<?php echo $this->content['login']['name']; ?>" value="<?php echo $this->content['login']['value']; ?>" <?php echo $this->content['login']['attrs']; ?>>
        <?php if(!empty($this->content['login']['text'])) { ?><br><i><?php echo $this->content['login']['text']; ?></i><?php } ?>
      </td>
      <td>
        <?php echo $this->content['login']['error']; ?>
      </td>
    </tr>
    <tr<?php if(!empty($this->content['password']['error'])) {echo ' style="background-color:#FAA"';} ?>>
      <td><?php echo $this->content['password']['title']; ?></td>
      <td>
        <input type="<?php echo $this->content['password']['type']; ?>" name="<?php echo $this->content['password']['name']; ?>" value="<?php echo $this->content['password']['value']; ?>" <?php echo $this->content['password']['attrs']; ?>>
        <?php if(!empty($this->content['password']['text'])) { ?><br><i><?php echo $this->content['password']['text']; ?></i><?php } ?>
      </td>
      <td>
        <?php echo $this->content['password']['error']; ?>
      </td>
    </tr>
    <tr<?php if(!empty($this->content['submit']['error'])) {echo ' style="background-color:#900"';} ?>>
      <td colspan="3">
        <div align="center">
          <input type="submit" name="<?php echo $this->content['submit']['name']; ?>" value="<?php echo $this->content['submit']['value']; ?>" <?php echo $this->content['submit']['attrs']; ?>><br>
        </div>
      </td>
    </tr>
</table>
<input type="hidden" name="<?php echo $this->content['antixsrf']['name']; ?>" value="<?php echo $this->content['antixsrf']['value']; ?>">
</form>