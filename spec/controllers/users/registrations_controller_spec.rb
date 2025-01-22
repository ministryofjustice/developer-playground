# frozen_string_literal: true

require 'rails_helper'

RSpec.describe Users::RegistrationsController, type: :controller do
  # Use Devise helpers for authentication
  include Devise::Test::ControllerHelpers

  let(:admin) { create(:user, role: 'admin') }
  let(:user) { create(:user, role: 'basic') }
  let(:other_user) { create(:user, role: 'basic') }

  before do
    # Specify that we're using the custom Devise routes
    @request.env['devise.mapping'] = Devise.mappings[:user] # rubocop:disable RSpec/InstanceVariable
  end

  describe 'GET #edit' do
    context 'when admin is logged in' do
      before { sign_in admin }

      it 'allows admin to edit any user profile' do
        get :edit, params: { id: user.id }
        expect(response).to have_http_status(:ok)
        expect(assigns(:user)).to eq(user)
      end
    end

    context 'when regular user is logged in' do
      before { sign_in user }

      it 'allows user to edit their own profile' do
        get :edit, params: { id: user.id }
        expect(response).to have_http_status(:ok)
        expect(assigns(:user)).to eq(user)
      end

      it 'redirects user when attempting to edit another user’s profile' do
        get :edit, params: { id: other_user.id }
        expect(response).to redirect_to(root_path)
        expect(flash[:alert]).to eq('Access denied.')
      end
    end
  end

  describe 'PUT #update' do
    context 'when admin is logged in' do
      before { sign_in admin }

      it 'allows admin to update any user profile' do
        put :update, params: { id: user.id, user: { username: 'NewUsername' } }
        expect(response).to redirect_to(edit_user_account_path(user))
        expect(flash[:notice]).to eq('User updated successfully.')
        user.reload
        expect(user.username).to eq('NewUsername')
      end
    end

    context 'when regular user is logged in' do
      before { sign_in user }

      it 'allows user to update their own profile' do
        put :update, params: { id: user.id, user: { username: 'UpdatedUsername' } }
        expect(response).to redirect_to(edit_user_registration_path)
        expect(flash[:notice]).to eq('User updated successfully.')
        user.reload
        expect(user.username).to eq('UpdatedUsername')
      end

      it 'redirects user when attempting to update another user’s profile' do
        put :update, params: { id: other_user.id, user: { username: 'HackedUsername' } }
        expect(response).to redirect_to(root_path)
        expect(flash[:alert]).to eq('Access denied.')
        other_user.reload
        expect(other_user.username).not_to eq('HackedUsername')
      end
    end
  end
end
