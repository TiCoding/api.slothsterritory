<!-- Documentation API -->

# Documentación API

## Descripción

Esta es la documentación de la API de Sloth's Territory.

## Diferentes filtros que se pueden aplicar a los endpoints

### Included

Este filtro permite incluir los recursos relacionados en la respuesta.

#### Ejemplo

`GET /api/v1/agencies?included=reservations`

### Filter

Este filtro permite filtrar los recursos por atributos.

#### Ejemplo

`GET /api/v1/agencies?filter[name]=Desafio`

### Sort

Este filtro permite ordenar los recursos por atributos.

#### Ejemplo

`GET /api/v1/agencies?sort=name` o `GET /api/v1/agencies?sort=-name`

### PerPage y Page

Estos filtros permiten paginar los recursos.

#### Ejemplo

`GET /api/v1/agencies?perPage=10&page=1`

### GetCustomDate (unicamente para el endpoint de CustomDate)

Este filtro permite buscar una fecha personalizada segun una fecha.

#### Ejemplo

`GET /api/v1/custom-dates?getCustomDate=2019-01-01`


## Endpoints

### Agency

#### campos fillables

- name (required)
- email (required)
- commission_dollars (required)
- commission_percent (required)
- color (required)

#### parametros permitidos para included

- reservations 
- tours
- tours.schedules
- agencyTours
- agencyTours.customDates
- agencyTours.tour
- agencyTours.customDates.customPrice
- agencyTours.customDates.customSchedules

#### parametros permitidos para filter

- id
- name
- email
- commission_dollars
- commission_percent
- color

#### parametros permitidos para sort

- id
- name
- email
- commission_dollars
- commission_percent
- color

#### GET /api/v1/agencies

Devuelve una lista de agencias.

#### GET /api/v1/agencies/{agency}

Devuelve una agencia.

#### POST /api/v1/agencies

Crea una agencia.

#### PUT /api/v1/agencies/{agency}

Actualiza una agencia.

#### DELETE /api/v1/agencies/{agency}

Elimina una agencia.

### AgencyData

#### campos fillables

- agent_name (required)
- reservation_id (required)

#### parametros permitidos para included

- reservation

#### parametros permitidos para filter

- id
- agent_name
- reservation_id

#### parametros permitidos para sort

- id
- agent_name
- reservation_id

#### GET /api/v1/agency-data

Devuelve una lista.

#### GET /api/v1/agency-data/{agencyData}

Devuelve un registro.

#### POST /api/v1/agency-data

Crea un registro.

#### PUT /api/v1/agency-data/{agencyData}

Actualiza un registro.

#### DELETE /api/v1/agency-data/{agencyData}

Elimina un registro.

### AgencyTour

#### campos fillables

- agency_id (required)
- tour_id (required)

#### parametros permitidos para included

- customDates
- customDates.customPrice
- customDates.customSchedules
- tour
- agency

#### parametros permitidos para filter

- id
- agency_id
- tour_id

#### parametros permitidos para sort

- id
- agency_id
- tour_id

#### GET /api/v1/agency-tours

Devuelve una lista de tours y agencias.

#### GET /api/v1/agency-tours/{agencyTour}

Devuelve un registro.

#### POST /api/v1/agency-tours

Crea un registro.

#### PUT /api/v1/agency-tours/{agencyTour}

Actualiza un registro.

#### DELETE /api/v1/agency-tours/{agencyTour}

Elimina un registro.

### Commission

#### campos fillables

- amount_dollars (required)
- amount_colones (required)
- reservation_id (required)
- payment_status_id (required)

#### parametros permitidos para included

- reservation
- paymentStatus
- payments
- payments.paymentMethod
- payments.paymentType

#### parametros permitidos para filter

- id
- amount_dollars
- amount_colones
- reservation_id
- payment_status_id

#### parametros permitidos para sort

- id
- amount_dollars
- amount_colones
- reservation_id
- payment_status_id

#### GET /api/v1/commissions

Devuelve una lista de comisiones.

#### GET /api/v1/commissions/{commission}

Devuelve una comisión.

#### POST /api/v1/commissions

Crea una comisión.

#### PUT /api/v1/commissions/{commission}

Actualiza una comisión.

#### DELETE /api/v1/commissions/{commission}

Elimina una comisión.

### CustomDate

#### campos fillables

- start_date (required)
- end_date (required)
- agency_tour_id (required)

#### parametros permitidos para included

- customPrice
- customSchedules
- agencyTour
- agencyTour.tour
- agencyTour.agency
- agencyTour.agency.reservations

#### parametros permitidos para filter

- id
- start_date
- end_date
- agency_tour_id

#### parametros permitidos para sort

- id
- start_date
- end_date
- agency_tour_id

#### GET /api/v1/custom-dates

Devuelve una lista de fechas personalizadas.

#### GET /api/v1/custom-dates/{customDate}

Devuelve una fecha personalizada.

#### POST /api/v1/custom-dates

Crea una fecha personalizada.

#### PUT /api/v1/custom-dates/{customDate}

Actualiza una fecha personalizada.

#### DELETE /api/v1/custom-dates/{customDate}

Elimina una fecha personalizada.

### CustomPrice

#### campos fillables

- adult_price (required)
- child_price (required)
- custom_date_id (required)

#### parametros permitidos para included

- customDate

#### parametros permitidos para filter

- id
- adult_price
- child_price
- custom_date_id

#### parametros permitidos para sort

- id
- adult_price
- child_price
- custom_date_id

#### GET /api/v1/custom-prices

Devuelve una lista de precios personalizados.

#### GET /api/v1/custom-prices/{customPrice}

Devuelve un precio personalizado.

#### POST /api/v1/custom-prices

Crea un precio personalizado.

#### PUT /api/v1/custom-prices/{customPrice}

Actualiza un precio personalizado.

#### DELETE /api/v1/custom-prices/{customPrice}

Elimina un precio personalizado.

### CustomSchedule

#### campos fillables

- schedule (required)
- capacity (required)
- deadline_hour (required)
- custom_date_id (required)

#### parametros permitidos para included

- customDate

#### parametros permitidos para filter

- id
- schedule
- capacity
- deadline_hour
- custom_date_id

#### parametros permitidos para sort

- id
- schedule
- capacity
- deadline_hour
- custom_date_id

#### GET /api/v1/custom-schedules

Devuelve una lista de horarios personalizados.

#### GET /api/v1/custom-schedules/{customSchedule}

Devuelve un horario personalizado.

#### POST /api/v1/custom-schedules

Crea un horario personalizado.

#### PUT /api/v1/custom-schedules/{customSchedule}

Actualiza un horario personalizado.

#### DELETE /api/v1/custom-schedules/{customSchedule}

Elimina un horario personalizado.

### Customer

#### campos fillables

- name (required)
- email (required)
- phone (not required)

#### parametros permitidos para included

- reservations

#### parametros permitidos para filter

- id
- name
- email
- phone

#### parametros permitidos para sort

- id
- name
- email
- phone

#### GET /api/v1/customers

Devuelve una lista de clientes.

#### GET /api/v1/customers/{customer}

Devuelve un cliente.

#### POST /api/v1/customers

Crea un cliente.

#### PUT /api/v1/customers/{customer}

Actualiza un cliente.

#### DELETE /api/v1/customers/{customer}

Elimina un cliente.

### Fee

#### campos fillables

- amount_dollars (required)
- amount_colones (required)
- reservation_id (required)
- payment_status_id (required)

#### parametros permitidos para included

- reservation
- paymentStatus
- payments
- payments.paymentMethod
- payments.paymentType

#### parametros permitidos para filter

- id
- amount_dollars
- amount_colones
- reservation_id
- payment_status_id

#### parametros permitidos para sort

- id
- amount_dollars
- amount_colones
- reservation_id
- payment_status_id

#### GET /api/v1/fees

Devuelve una lista de comisiones.

#### GET /api/v1/fees/{fee}

Devuelve una comisión.

#### POST /api/v1/fees

Crea una comisión.

#### PUT /api/v1/fees/{fee}

Actualiza una comisión.

#### DELETE /api/v1/fees/{fee}

Elimina una comisión.

### Guide

#### campos fillables

- name (required)
- guide_status_id (required)

#### parametros permitidos para included

- guideStatus
- tourGroups
- tourGroups.reservations

#### parametros permitidos para filter

- id
- name
- guide_status_id

#### parametros permitidos para sort

- id
- name
- guide_status_id

#### GET /api/v1/guides

Devuelve una lista de guías.

#### GET /api/v1/guides/{guide}

Devuelve una guía.

#### POST /api/v1/guides

Crea una guía.

#### PUT /api/v1/guides/{guide}

Actualiza una guía.

#### DELETE /api/v1/guides/{guide}

Elimina una guía.

### GuideStatus

#### campos fillables

- name (required)

#### parametros permitidos para included

- guides

#### parametros permitidos para filter

- id
- name

#### parametros permitidos para sort

- id
- name

#### GET /api/v1/guide-statuses

Devuelve una lista de estados de guías.

#### GET /api/v1/guide-statuses/{guideStatus}

Devuelve un estado de guía.

#### POST /api/v1/guide-statuses

Crea un estado de guía.

#### PUT /api/v1/guide-statuses/{guideStatus}

Actualiza un estado de guía.

#### DELETE /api/v1/guide-statuses/{guideStatus}

Elimina un estado de guía.

### Payment

#### campos fillables

- dollar_amount (required)
- colones_amount (required)
- payment_date (required)
- path_file (not required)
- payment_method_id (required)
- payment_type_id (required)
- paymentable_id (required)
- paymentable_type (required)

#### parametros permitidos para included

- paymentMethod
- paymentType
- paymentable
- reservation

#### parametros permitidos para filter

- id
- dollar_amount
- colones_amount
- payment_date
- path_file
- payment_method_id
- payment_type_id
- paymentable_id
- paymentable_type

#### parametros permitidos para sort

- id
- dollar_amount
- colones_amount
- payment_date
- path_file
- payment_method_id
- payment_type_id
- paymentable_id
- paymentable_type

#### GET /api/v1/payments

Devuelve una lista de pagos.

#### GET /api/v1/payments/{payment}

Devuelve un pago.

#### POST /api/v1/payments

Crea un pago.

#### PUT /api/v1/payments/{payment}

Actualiza un pago.

#### DELETE /api/v1/payments/{payment}

Elimina un pago.

### PaymentMethod

#### campos fillables

- name (required)

#### parametros permitidos para included

- payments

#### parametros permitidos para filter

- id
- name

#### parametros permitidos para sort

- id
- name

#### GET /api/v1/payment-methods

Devuelve una lista de métodos de pago.

#### GET /api/v1/payment-methods/{paymentMethod}

Devuelve un método de pago.

#### POST /api/v1/payment-methods

Crea un método de pago.

#### PUT /api/v1/payment-methods/{paymentMethod}

Actualiza un método de pago.

#### DELETE /api/v1/payment-methods/{paymentMethod}

Elimina un método de pago.

### PaymentStatus

#### campos fillables

- name (required)

#### parametros permitidos para included

- fees
- reservations
- commissions

#### parametros permitidos para filter

- id
- name

#### parametros permitidos para sort

- id
- name

#### GET /api/v1/payment-statuses

Devuelve una lista de estados de pago.

#### GET /api/v1/payment-statuses/{paymentStatus}

Devuelve un estado de pago.

#### POST /api/v1/payment-statuses

Crea un estado de pago.

#### PUT /api/v1/payment-statuses/{paymentStatus}

Actualiza un estado de pago.

#### DELETE /api/v1/payment-statuses/{paymentStatus}

Elimina un estado de pago.

### PaymentType

#### campos fillables

- name (required)

#### parametros permitidos para included

- payments

#### parametros permitidos para filter

- id
- name

#### parametros permitidos para sort

- id
- name

#### GET /api/v1/payment-types

Devuelve una lista de tipos de pago.

#### GET /api/v1/payment-types/{paymentType}

Devuelve un tipo de pago.

#### POST /api/v1/payment-types

Crea un tipo de pago.

#### PUT /api/v1/payment-types/{paymentType}

Actualiza un tipo de pago.

#### DELETE /api/v1/payment-types/{paymentType}

Elimina un tipo de pago.

### Reservation

#### campos fillables

- amount_adults (required)
- amount_children (required)
- amount_children_free (required)
- total_price_dollars (required)
- total_price_colones (required)
- discount_dollars (required)
- discount_colones (required)
- taxes_dollars (required)
- taxes_colones (required)
- net_price_dollars (required)
- net_price_colones (required)
- invoice (not required)
- comments (not required)
- date (required)
- adult_price_dollars (required)
- adult_price_colones (required)
- child_price_dollars (required)
- child_price_colones (required)
- schedule (required)
- agency_id (required)
- customer_id (required)
- payment_status_id (required)
- reservation_status_id (required)
- tour_id (required)
- tour_group_id (required)
- user_id (required)

#### parametros permitidos para included

- agency
- customer
- paymentStatus
- reservationStatus
- tour
- tourGroup
- tourGroup.guide
- tour.schedules
- agency.tours
- agency.agencyTours
- agency.agencyTours.customDates
- agency.agencyTours.customDates.customPrice
- agency.agencyTours.customDates.customSchedules
- payments
- payments.paymentMethod
- payments.paymentType
- agencyData
- fee
- fee.payments
- fee.paymentsStatus
- commission
- commission.payments
- commission.paymentsStatus
- user

#### parametros permitidos para filter

- id
- amount_adults
- amount_children
- amount_children_free
- total_price_dollars
- total_price_colones
- discount_dollars
- discount_colones
- taxes_dollars
- taxes_colones
- net_price_dollars
- net_price_colones
- invoice
- comments
- date
- adult_price_dollars
- adult_price_colones
- child_price_dollars
- child_price_colones
- schedule
- agency_id
- customer_id
- payment_status_id
- reservation_status_id
- tour_id
- tour_group_id
- user_id

#### parametros permitidos para sort

- id
- amount_adults
- amount_children
- amount_children_free
- total_price_dollars
- total_price_colones
- discount_dollars
- discount_colones
- taxes_dollars
- taxes_colones
- net_price_dollars
- net_price_colones
- invoice
- comments
- date
- adult_price_dollars
- adult_price_colones
- child_price_dollars
- child_price_colones
- schedule
- agency_id
- customer_id
- payment_status_id
- reservation_status_id
- tour_id
- tour_group_id
- user_id

#### GET /api/v1/reservations

Devuelve una lista de reservas.

#### GET /api/v1/reservations/{reservation}

Devuelve una reserva.

#### POST /api/v1/reservations

Crea una reserva.

#### PUT /api/v1/reservations/{reservation}

Actualiza una reserva.

#### DELETE /api/v1/reservations/{reservation}

Elimina una reserva.

### ReservationStatus

#### campos fillables

- name (required)

#### parametros permitidos para included

- reservations

#### parametros permitidos para filter

- id
- name

#### parametros permitidos para sort

- id
- name

#### GET /api/v1/reservation-statuses

Devuelve una lista de estados de reserva.

#### GET /api/v1/reservation-statuses/{reservationStatus}

Devuelve un estado de reserva.

#### POST /api/v1/reservation-statuses

Crea un estado de reserva.

#### PUT /api/v1/reservation-statuses/{reservationStatus}

Actualiza un estado de reserva.

#### DELETE /api/v1/reservation-statuses/{reservationStatus}

Elimina un estado de reserva.

### Role

#### campos fillables

- name (required)

#### parametros permitidos para included

- users

#### parametros permitidos para filter

- id
- name

#### parametros permitidos para sort

- id
- name

#### GET /api/v1/roles

Devuelve una lista de roles.

#### GET /api/v1/roles/{role}

Devuelve un rol.

#### POST /api/v1/roles

Crea un rol.

#### PUT /api/v1/roles/{role}

Actualiza un rol.

#### DELETE /api/v1/roles/{role}

Elimina un rol.

### Schedule

#### campos fillables

- schedule (required)
- capacity (required)
- deadline_hour (required)
- tour_id (required)

#### parametros permitidos para included

- tour

#### parametros permitidos para filter

- id
- schedule
- capacity
- deadline_hour
- tour_id

#### parametros permitidos para sort

- id
- schedule
- capacity
- deadline_hour
- tour_id

#### GET /api/v1/schedules

Devuelve una lista de horarios.

#### GET /api/v1/schedules/{schedule}

Devuelve un horario.

#### POST /api/v1/schedules

Crea un horario.

#### PUT /api/v1/schedules/{schedule}

Actualiza un horario.

#### DELETE /api/v1/schedules/{schedule}

Elimina un horario.

### Tour

#### campos fillables

- name (required)
- description (required)
- path_image (required)
- adult_price (required)
- child_price (required)

#### parametros permitidos para included

- schedules
- agencyTours
- agencies
- reservations

#### parametros permitidos para filter

- id
- name
- description
- path_image
- adult_price
- child_price

#### parametros permitidos para sort

- id
- name
- description
- path_image
- adult_price
- child_price

#### GET /api/v1/tours

Devuelve una lista de tours.

#### GET /api/v1/tours/{tour}

Devuelve un tour.

#### POST /api/v1/tours

Crea un tour.

#### PUT /api/v1/tours/{tour}

Actualiza un tour.

#### DELETE /api/v1/tours/{tour}

Elimina un tour.

### TourGroup

#### campos fillables

- name (required)
- guide_id (required)
- date (required)
- schedule (required)

#### parametros permitidos para included

- guide
- reservations

#### parametros permitidos para filter

- id
- name
- guide_id
- date
- schedule

#### parametros permitidos para sort

- id
- name
- guide_id
- date
- schedule

#### GET /api/v1/tour-groups

Devuelve una lista de grupos de tours.

#### GET /api/v1/tour-groups/{tourGroup}

Devuelve un grupo de tours.

#### POST /api/v1/tour-groups

Crea un grupo de tours.

#### PUT /api/v1/tour-groups/{tourGroup}

Actualiza un grupo de tours.

#### DELETE /api/v1/tour-groups/{tourGroup}

Elimina un grupo de tours.

### User

#### campos fillables

- name (required)
- email (required)
- password (required)
- role_id (required)

#### parametros permitidos para included

- role
- reservations

#### parametros permitidos para filter

- id
- name
- email
- role_id

#### parametros permitidos para sort

- id
- name
- email
- role_id

#### GET /api/v1/users

Devuelve una lista de usuarios.

#### GET /api/v1/users/{user}

Devuelve un usuario.

#### POST /api/v1/users

Crea un usuario.

#### PUT /api/v1/users/{user}

Actualiza un usuario.

#### DELETE /api/v1/users/{user}

Elimina un usuario.

