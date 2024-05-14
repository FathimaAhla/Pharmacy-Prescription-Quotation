@if ($request->status == 'accept')
    <div>
        <p>
            Subject: Acceptance of Quotation

            Dear Xiteb,

            I hope this email finds you well. I have reviewed the quotation provided for the prescription of You,
            and I am pleased to inform you that we accept the terms outlined.

            We appreciate your prompt response and look forward to proceeding with the fulfillment of the prescription.

            Thank You
        </p>
    </div>
@else
    <div>
        <p>
            Subject: Rejection of Quotation

            Dear Xiteb,

            I hope this email finds you well. Thank you for providing the quotation for the prescription of You.

            After careful consideration, we have decided to decline the quotation provided at this time. We may revisit our
            options in the future and will keep your pharmacy in mind for any further needs.

            Thank you for your understanding.

            Thank You
        </p>
    </div>
@endif
