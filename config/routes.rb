# frozen_string_literal: true

# == Route Map
#

Rails.application.routes.draw do
  root 'articles#home'
  get 'search', to: 'search#index'

  resources :admins do
    collection do
      get :home
    end
  end

  devise_for :users, controllers: {
    sessions: 'users/sessions',
    registrations: 'users/registrations'
  }

  # Route to edit any user’s account by their ID
  devise_scope :user do
    get '/users/:id/edit', to: 'users/registrations#edit', as: 'edit_user_account'
    put '/users/:id', to: 'users/registrations#update'
  end

  # allows for chained url routes
  # eg. /posts/1/comments/4
  resources :articles do
    resources :comments
  end
end
