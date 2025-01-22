# frozen_string_literal: true

require 'rails_helper'

RSpec.describe 'Articles', type: :request do
  let(:admin_user) { create(:admin) }
  let(:guest_user) { create(:guest) }
  let(:basic_user) { create(:basic) }

  describe '#home' do
    context 'with admin user' do
      before do
        sign_in admin_user
      end

      it 'renders the users home page' do
        get root_path
        expect(response).to have_http_status(:successful)
      end
    end

    context 'with basic user' do
      before do
        sign_in basic_user
      end

      it 'renders the users home page' do
        get root_path
        expect(response).to have_http_status(:successful)
      end
    end

    context 'with guest user' do
      before do
        sign_in guest_user
      end

      it 'renders the users home page' do
        get root_path
        expect(response).to have_http_status(:successful)
      end
    end

    context 'with no user signed in' do
      it 'redirects to the sign in page' do
        get root_path
        expect(response).to redirect_to user_session_path
      end
    end
  end
end
