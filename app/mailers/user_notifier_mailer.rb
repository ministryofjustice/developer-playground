# frozen_string_literal: true

class UserNotifierMailer < ApplicationMailer
  default from: 'shaw51@hotmail.co.uk'

  # Send a sign up email for the user, pass in the user object that contains the users email address
  def send_signup_email(user)
    @user = user
    mail(to: @user.email,
         subject: 'Thanks for signing up to the Car blog')
  end
end
