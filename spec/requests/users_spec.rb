# frozen_string_literal: true

require 'rails_helper'

RSpec.describe 'Users', type: :request do
  let(:admin_user) { create(:admin) }
  let(:guest_user) { create(:guest) }
  let(:basic_user) { create(:basic) }

  describe 'GET /index' do
    context 'when logged in as admin user' do
      before do
        sign_in admin_user
      end

      it 'renders admin homepage' do
        get home_admins_path
        expect(response).to have_http_status(:successful)
        expect(response).to render_template :home
      end
    end

    context 'when logged in as guest user' do
      before do
        sign_in guest_user
      end

      it 'redirects to the sign in page' do
        get home_admins_path
        expect(response).to have_http_status(:redirect)
        expect(response).to redirect_to user_session_path
      end
    end

    context 'when logged in as basic user' do
      before do
        sign_in basic_user
      end

      it 'redirects to the sign in' do
        get home_admins_path
        expect(response).to have_http_status(:redirect)
        expect(response).to redirect_to user_session_path
      end
    end
  end
end
