<address-book :user="user" inline-template>
    <div>
        <div>
            <!-- Create Address Book -->
            @include('settings.address-book.create-address')
        </div>

        <!-- Address Book -->
        <div>
            @include('settings.address-book.address')
        </div>        
    </div>
</address-book>
