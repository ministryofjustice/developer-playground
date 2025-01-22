# frozen_string_literal: true

require 'rails_helper'

RSpec.describe AdminsController, type: :controller do
  let(:admin_user) { create(:admin) }

  describe 'GET #index' do
    context 'with admin user' do
      before do
        sign_in admin_user
      end

      it 'renders the :admin template' do
        get :home
        expect(response).to render_template(:home)
      end
    end

    context 'when a non admin user' do
      it 'redirects to root route' do
        get :home
        expect(response).to redirect_to(new_user_session_path)
      end
    end
  end
end
