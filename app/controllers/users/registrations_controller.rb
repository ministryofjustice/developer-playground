# frozen_string_literal: true

module Users
  class RegistrationsController < Devise::RegistrationsController
    before_action :authenticate_user!
    before_action :set_user, only: %i[edit update]
    before_action :authorise_admin_or_self, only: %i[edit update]
    before_action :configure_sign_up_params, only: [:create]
    before_action :configure_account_update_params, only: [:update]

    # PUT /users/:id - Updates the user’s information, ensuring only allowed fields are updated
    def update
      if @user.update(account_update_params)
        redirect_to after_update_path_for(@user), notice: 'User updated successfully.'
      else
        render :edit
      end
    end

    # Customize where users are redirected after updating their account
    def after_update_path_for(resource)
      current_user.admin? ? edit_user_account_path(resource) : edit_user_registration_path
    end

    private

    # Retrieve the user by ID if available, otherwise use the current user
    def set_user
      @user = params[:id].present? ? User.find(params[:id]) : current_user
    end

    # Only allow admins or the user themselves to access the edit/update actions
    def authorise_admin_or_self
      return if current_user.admin? || current_user == @user

      redirect_to root_path, alert: 'Access denied.'
    end

    # Permit extra parameters for sign-up
    def configure_sign_up_params
      devise_parameter_sanitizer.permit(:sign_up, keys: %i[username avatar])
    end

    # Permit extra parameters for account update
    def configure_account_update_params
      devise_parameter_sanitizer.permit(:account_update, keys: %i[username avatar role])
    end
  end
end
