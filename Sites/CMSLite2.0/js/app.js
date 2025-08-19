const app = {
    selectedCategory: '',
    selectedListItem: 0, 
    lastAnswer: {},
    init(){
        const createButton = document.querySelector('.btn-create');
        const editButton = document.querySelector('.btn-edit');
        const deletetButton = document.querySelector('.btn-delete');
        createButton.disabled = true;
        editButton.disabled = true;
        deletetButton.disabled = true;
        createButton.classList.add('disabled');
        editButton.classList.add('disabled');
        deletetButton.classList.add('disabled');
        this.showContent();
    },
    async showContent(){
        const menu = document.getElementById('menu');
        const response = await this.API.get();
        if (!response.ok) {
            console.error('При запросе меню сервер вернул ошибку');
            return;
        }
        
        response.menu.forEach(element => {
            let item = document.createElement('div');
            item.textContent = element.name;
            item.dataset.resource = element.resource;
            item.classList.add('cell');
            item.addEventListener('click', function() {
                app.selectCategory(this);
            });
            menu.appendChild(item);
        });
    },
    async selectCategory(el = null){
        const menu = document.getElementById('menu');
        const list = document.getElementById('list');
        const data = document.getElementById('data');
    
        
        const createButton = document.querySelector('.btn-create');
        const editButton = document.querySelector('.btn-edit');
        const deletetButton = document.querySelector('.btn-delete');
        createButton.disabled = false;
        editButton.disabled = true;
        deletetButton.disabled = true;
        createButton.classList.remove('disabled');
        editButton.classList.add('disabled');
        deletetButton.classList.add('disabled');
        this.selectedListItem = 0;
        if (el != null) {
            menu.querySelectorAll('.cell').forEach(element => {
                element.classList.remove('selected');
            });
            el.classList.add('selected');
            this.selectedCategory = el.dataset.resource;
        }
        list.innerHTML = '';
        data.innerHTML = '';
        const response = await this.API.get(this.selectedCategory);
        if (!response.ok) {
            console.error('При запросе меню сервер вернул ошибку');
            return;
        }
        switch (this.selectedCategory) {
            case 'deals':
                response.deals.forEach(element => {
                    let item = document.createElement('div');
                    item.textContent = element.name;
                    item.dataset.id = element.id;
                    item.classList.add('cell');
                    item.addEventListener('click', function() {
                        app.selectListItem(this);
                    });
                    list.appendChild(item);
                });
            break;
            case 'contacts':
                response.contacts.forEach(element => {
                    let item = document.createElement('div');
                    item.textContent = element.first_name+' '+element.last_name;
                    item.dataset.id = element.id;
                    item.classList.add('cell');
                    item.addEventListener('click', function() {
                        app.selectListItem(this);
                    });
                    list.appendChild(item);
                });
            break;
        }
    },
    async selectListItem(el){
        const list = document.getElementById('list');
        const deletetButton = document.querySelector('.btn-delete');
        const editButton = document.querySelector('.btn-edit');
        deletetButton.disabled = false;
        editButton.disabled = false;
        deletetButton.classList.remove('disabled');
        editButton.classList.remove('disabled');
        list.querySelectorAll('.cell').forEach(element => {
            element.classList.remove('selected');
        });
        el.classList.add('selected');
        this.selectedListItem = +el.dataset.id;
        const data = document.getElementById('data');
        const response = await this.API.get(this.selectedCategory,this.selectedListItem);
        if (!response.ok) {
            console.error('При запросе меню сервер вернул ошибку');
            return;
        }
        
        let html = '';
        switch (this.selectedCategory) {
            case 'deals':
                html = `
                    <div class="d-flex">
                        <div class="cell w-50">id сделки</div><div class="cell w-50">${response.deal.id}</div>
                    </div>
                    <div class="d-flex">
                        <div class="cell w-50">Наименование</div><div class="cell w-50">${response.deal.name}</div>
                    </div>
                    <div class="d-flex">
                        <div class="cell w-50">Сумма</div><div class="cell w-50">${response.deal.price}</div>
                    </div>
                `;
                if (response.deal?.contacts) {
                    response.deal.contacts.forEach(element => {
                        html+= `
                            <div class="d-flex">
                                <div class="cell w-50">id контакта: ${element.id}</div><div class="cell w-50">${element.first_name} ${element.last_name}</div>
                            </div>
                        `;
                    });
                }
                data.innerHTML = html;
            break;
            case 'contacts':
                html = `
                    <div class="d-flex">
                        <div class="cell w-50">id контакта</div><div class="cell w-50">${response.contact.id}</div>
                    </div>
                    <div class="d-flex">
                        <div class="cell w-50">Имя</div><div class="cell w-50">${response.contact.first_name}</div>
                    </div>
                    <div class="d-flex">
                        <div class="cell w-50">Фамилия</div><div class="cell w-50">${response.contact.last_name}</div>
                    </div>
                `;
                if (response.contact?.deals) {
                    response.contact.deals.forEach(element => {
                        html+= `
                            <div class="d-flex">
                                <div class="cell w-50">id сделки: ${element.id}</div><div class="cell w-50">${element.name}</div>
                            </div>
                        `;
                    });
                }
                data.innerHTML = html;
            break;
        }
    },
    API:{
        host:'http://localhost/test',
        async get(category = null, id = null, save = true){
            try {
                url = '/api/engine.php';
                category != null ? url += '?resource='+category : url +='';
                id != null ? url += '&id='+id : url +='';
                response = await fetch(this.host+url);
                if (!response.ok) throw new Error('Ошибка сети');
                data = await response.json();
                if (save) {
                    app.lastAnswer = data;
                }
                return data;
            } catch (error) {
                console.error('Ошибка при получении:', error);
                throw error;
            }
        },
        async delete(category, id, save = true){
            try {
                response = await fetch(this.host+'/api/engine.php?resource='+category+'&id='+id, {
                    method: 'DELETE'
                });
                if (save) {
                    app.lastAnswer = response;
                }
                if (!response.status) throw new Error('Ошибка сети');
                if (response.status === 204 || response.status === 200) 
                    return true;
                else
                    return false;
            } catch (error) {
                console.error('Ошибка при удалении:', error);
                throw error;
            }
        },
        async post(category, data, save = true){
            try {
                response = await fetch(this.host+'/api/engine.php?resource='+category, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });
                if (!response.ok) throw new Error('Ошибка сети');
                data = await response.json();
                if (save) {
                    app.lastAnswer = data;
                }
                return data;
            } catch (error) {
                console.error('Ошибка при добавлении:', error);
                throw error;
            }
        },
        async put(category, id, data, save = true){
            try {
                response = await fetch(this.host+'/api/engine.php?resource='+category+'&id='+id, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });
                if (!response.ok) throw new Error('Ошибка сети');
                data = await response.json();
                if (save) {
                    app.lastAnswer = data;
                }
                return data;
            } catch (error) {
                console.error('Ошибка при добавлении:', error);
                throw error;
            }
        }
    },
    modal: {
        selectedItems: [],
        currentAction: '',
        updateSelectedItems(checkbox) {
            const contactId = parseInt(checkbox.value);
            const label = checkbox.nextElementSibling;
            
            if (checkbox.checked) {
                if (!this.selectedItems.includes(contactId)) {
                    this.selectedItems.push(contactId);
                }
                label.classList.add('modal-btn-primary');
            } else {
                this.selectedItems = this.selectedItems.filter(id => id !== contactId);
                label.classList.remove('modal-btn-primary');
            }
        },
        async openFormModal(type) {
            const divModal = document.getElementById('formModal');
            const title = document.getElementById('formModalTitle');
            const formFields = document.getElementById('formFields');
            const actions = document.getElementById('formModalActions');
            actions.innerHTML='';
            let actionBtn = document.createElement('button');
            actionBtn.classList.add('modal-btn', 'modal-btn-secondary');
            actionBtn.textContent = 'Отмена';
            actionBtn.addEventListener('click', function() {
                app.modal.closeFormModal();
            });
            actions.appendChild(actionBtn);
            actionBtn = document.createElement('button');
            actionBtn.classList.add('modal-btn', 'modal-btn-primary');
            actionBtn.id = 'formModalBtnPrimary';
            actionBtn.textContent = 'Сохранить';
            actionBtn.addEventListener('click', function() {
                app.modal.submitForm();
            });
            actions.appendChild(actionBtn);
            app.modal.currentAction = type;
            const btn = document.getElementById('formModalBtnPrimary');
            
            if (type === 'edit') {
                btn.textContent = 'Изменить';
                if (app.selectedCategory == 'deals') {
                    title.textContent = 'Редактирование сделки';
                } else if (app.selectedCategory == 'contacts') {
                    title.textContent = 'Редактирование контакта';
                }
            } else {
                btn.textContent = 'Создать';
                if (app.selectedCategory == 'deals') {
                    title.textContent = 'Создание сделки';
                } else if (app.selectedCategory == 'contacts') {
                    title.textContent = 'Создание контакта';
                }
            }
            formFields.innerHTML = '';
            try {
                switch (app.selectedCategory) {
                    case 'deals':
                        type == 'edit' ? selectedContactIds = app.lastAnswer.deal.contacts.map(contact => contact.id) : selectedContactIds = [];
                        
                        app.modal.selectedItems = selectedContactIds;
                        formFields.innerHTML = `
                            <div class="form-group">
                                <label for="dealName">Наименование</label>
                                <input type="text" id="dealName" ${type === 'edit' ? `value="${app.lastAnswer.deal.name}"` : ''} placeholder="Введите наименование сделки">
                            </div>
                            <div class="form-group">
                                <label for="dealPrice">Сумма</label>
                                <input type="number" id="dealPrice" ${type === 'edit' ? `value="${app.lastAnswer.deal.price}"` : ''}  placeholder="Введите сумму">
                            </div>`;
                        response = await app.API.get('contacts', null, false);
                        contacts = response.contacts || [];
                        if (contacts.length > 0) {
                            formFields.innerHTML += `
                                <div class="form-group">
                                    <label>Контакт</label>
                                    <div id="contactsList" class="contactsList">
                                        ${contacts.map(contact => `
                                            <div style="margin-bottom: 5px;">
                                                <input type="checkbox" id="contact_${contact.id}" value="${contact.id}" 
                                                    ${selectedContactIds.includes(contact.id) ? 'checked' : ''}
                                                    onchange="app.modal.updateSelectedItems.call(app.modal, this)">
                                                <label for="contact_${contact.id}" style="display: block;"
                                                    ${selectedContactIds.includes(contact.id) ? 'class="modal-btn-primary"' : ''}>
                                                    ${contact.first_name} ${contact.last_name}
                                                </label>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                            `;
                        }
                        if (type === 'edit') {
                            formFields.innerHTML += `<input id="dealId" type="hidden" value="${app.lastAnswer.deal.id}">`;
                        }
                        break;
                    case 'contacts':
                        type == 'edit' ? selectedDealIds = app.lastAnswer.contact.deals.map(deal => deal.id) : selectedDealIds = [];
                        app.modal.selectedItems = selectedDealIds;
                        formFields.innerHTML = `
                            <div class="form-group">
                                <label for="firstName">Имя</label>
                                <input type="text" id="firstName" ${type === 'edit' ? `value="${app.lastAnswer.contact.first_name}"` : ''}  placeholder="Введите имя">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Фамилия</label>
                                <input type="text" id="lastName" ${type === 'edit' ? `value="${app.lastAnswer.contact.last_name}"` : ''}  placeholder="Введите фамилию">
                            </div>`;
                        response = await app.API.get('deals', null, false);
                        deals = response.deals || [];
                        if (deals.length > 0) {
                            formFields.innerHTML += `
                                <div class="form-group">
                                    <label>Сделка</label>
                                    <div id="contactsList" class="contactsList">
                                        ${deals.map(deal => `
                                            <div style="margin-bottom: 5px;">
                                                <input type="checkbox" id="contact_${deal.id}" value="${deal.id}" 
                                                    ${selectedDealIds.includes(deal.id) ? 'checked' : ''}
                                                    onchange="app.modal.updateSelectedItems.call(app.modal, this)">
                                                <label for="contact_${deal.id}" style="display: block;"
                                                    ${selectedDealIds.includes(deal.id) ? 'class="modal-btn-primary"' : ''}>
                                                    ${deal.name}
                                                </label>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                            `;
                        }
                        if (type === 'edit') {
                            formFields.innerHTML += `<input id="contactId" type="hidden" value="${app.lastAnswer.contact.id}">`;
                        }
                        break;
                }
            } catch (error) {
                console.error('Ошибка при загрузке контактов:', error);
                formFields.innerHTML = '<div class="error">Не удалось загрузить контакты</div>';
            }
            
            divModal.style.display = 'flex';
        },          
        closeFormModal() {
            app.modal.selectedItems = [];
            app.modal.currentAction = '';
            document.getElementById('formModal').style.display = 'none';
        },
        openConfirmModal() {
            const data = document.getElementById('data');
            switch (app.selectedCategory) {
                case 'deals':
                    deal__id = data.children[0].children[1].textContent;
                    deal__name = data.children[1].children[1].textContent;
                    document.getElementById('data_confirmBeforeDelete').innerText = `сделку #${deal__id} "${deal__name}"`;
                break;
                case 'contacts':
                    contact__id = data.children[0].children[1].textContent;
                    contact__first_name = data.children[1].children[1].textContent;
                    contact__last_name = data.children[2].children[1].textContent;
                    document.getElementById('data_confirmBeforeDelete').innerText = `контакт #${contact__id} "${contact__first_name} ${contact__last_name}"`;
                break;
            }
            document.getElementById('confirmModal').style.display = 'flex';
        },                
        closeConfirmModal() {
            document.getElementById('confirmModal').style.display = 'none';
        },                
        async confirmDelete() {
            response = await app.API.delete(app.selectedCategory,app.selectedListItem);
            response ? alert('Удаление прошло успешно') : alert('Не удалось выполнить удаление');
            app.selectCategory();
            this.closeConfirmModal();
        },                
        async submitForm() {
            if (app.selectedCategory === 'deals') {
                const dealName = document.getElementById('dealName')?.value;
                const dealPrice = document.getElementById('dealPrice')?.value;
                
                if (app.modal.currentAction == 'create') {
                    if (dealName) {
                        response = await app.API.post(app.selectedCategory,{
                            'name': dealName,
                            'price': dealPrice,
                            'contacts': this.selectedItems
                        });
                        response.ok ? alert('Сделка добавлена') : alert('Не удалось добавить сделку');
                        app.modal.closeFormModal();
                        app.selectCategory();
                    } else {
                        alert('Поле "Наименование" - обязательное для заполнения');
                        document.getElementById('dealName').focus();
                        return;
                    } 
                }else if (app.modal.currentAction == 'edit'){
                    const dealId = document.getElementById('dealId')?.value;
                    if (dealName && dealId) {
                        response = await app.API.put(app.selectedCategory, dealId, {
                            'name': dealName,
                            'price': dealPrice,
                            'contacts': this.selectedItems
                        });
                        response.ok ? alert('Данные сделки обновлены') : alert('Не удалось обновить данные сделки');
                        app.modal.closeFormModal();
                        app.selectCategory();
                    } else {
                        alert('Поле "Наименование" - обязательное для заполнения');
                        document.getElementById('dealName').focus();
                        return;
                    } 
                }
            } else if (app.selectedCategory === 'contacts') {
                const firstName = document.getElementById('firstName')?.value;
                const lastName = document.getElementById('lastName')?.value;
                
                if (app.modal.currentAction == 'create') {
                    if (firstName) {
                        response = await app.API.post(app.selectedCategory,{
                            'first_name': firstName,
                            'last_name': lastName,
                            'deals': this.selectedItems
                        });
                        response.ok ? alert('Контакт добавлен') : alert('Не удалось добавить контакт');
                        app.modal.closeFormModal();
                        app.selectCategory();
                    } else {
                        alert('Поле "Имя" - обязательное для заполнения');
                        document.getElementById('firstName').focus();
                        return;
                    }
                }else if (app.modal.currentAction == 'edit'){
                    const contactId = document.getElementById('contactId')?.value;
                    if (firstName, contactId) {
                        response = await app.API.put(app.selectedCategory, contactId, {
                            'first_name': firstName,
                            'last_name': lastName,
                            'deals': this.selectedItems
                        });
                        response.ok ? alert('Данные контакта обновлены') : alert('Не удалось обновить данные контакта');
                        app.modal.closeFormModal();
                        app.selectCategory();
                    } else {
                        alert('Поле "Имя" - обязательное для заполнения');
                        document.getElementById('firstName').focus();
                        return;
                    } 
                }
            }
            app.modal.selectedItems = [];
            app.modal.currentAction = '';
        }
    }
}

window.onload = app.init();