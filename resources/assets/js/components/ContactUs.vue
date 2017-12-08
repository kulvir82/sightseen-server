<template lang="html">
  <div class="container h-100 margin-top-xl">
    <div class="row h-100 padding-top-lg">
      <div class="col-md-6 padding-top-lg padding-bottom-xl">
        <h2>Email us </h2>
        <div class="contactusform">
          <div class="name padding-md">
            <input class="form-control"  type="text" name="name" placeholder="Name">
          </div>
          <div class="emale padding-md">
            <input class="form-control" type="email" name="email" placeholder="Email">
          </div>
          <div class="message padding-md">
            <textarea class="form-control" name="message" rows="8" cols="80" placeholder="Message"></textarea>
          </div>
          <div class="submitbtn padding-md">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
          </div>
        </div>
      </div>
      <div class="col-md-6 padding-top-lg">
        <h2>Location</h2>
        <div class="address">
          <div class="">
            <i class="fa fa-map-marker"></i>
          </div>
          <div class="">
            <i class="fa fa-phone"></i>
          </div>
          <div class="">
            <i class="fa fa-fax"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
}
</script>

<style lang="css">
</style>
