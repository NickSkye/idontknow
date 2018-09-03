@extends('layouts.dashboard')
<?php $page = 'about'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    {{--<img src="{{ Session::get('path') }}">--}}
                @endif

                {{--MODAL FOR SHOUTS--}}


                <div class="modal fade" id="sendShout" tabindex="-1" role="dialog" aria-labelledby="sendshoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sendshoutModalLabel">Shout!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn btn-primary">Shout Back!</button>--}}
                            {{--<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>

                {{--END MODALS FOR SHOUTS--}}

                <div class="card">
                    <div class="card-header">



                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div>
                                <h1 style="text-align: center;">Welcome to FrendGrid!</h1>
                                <br><br>

                                <ol start="1" style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;list-style:decimal;user-select: text;">
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;user-select: text;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">License</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="1">Under this End User License Agreement (the "Agreement"), FrendGrid (the "Vendor") grants to the user (the "Licensee") a non-exclusive and non-transferable license (the "License") to use FrendGrid (the "Software").<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="2">"Software" includes the executable computer programs and any related printed, electronic and online documentation and any other files that may accompany the product.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="3">Title, copyright, intellectual property rights and distribution rights of the Software remain exclusively with the Vendor. Intellectual property rights include the look and feel of the Software. This Agreement constitutes a license for use only and is not in any way a transfer of ownership rights to the Software.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="4">The Software may be loaded onto no more than one computer. A single copy may be made for backup purposes only.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="5">The rights and obligations of this Agreement are personal rights granted to the Licensee only. The Licensee may not transfer or assign any of the rights or obligations granted under this Agreement to any other person or legal entity. The Licensee may not make available the Software for use by one or more third parties.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="6">The Software may not be modified, reverse-engineered, or de-compiled in any manner through current or future available technologies.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="7">Failure to comply with any of the terms under the License section will be considered a material breach of this Agreement.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">License Fee</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="8">The original purchase price paid by the Licensee will constitute the entire license fee and is the full consideration for this Agreement.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Limitation of Liability</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="9">The Software is provided by the Vendor and accepted by the Licensee "as is". Liability of the Vendor will be limited to a maximum of the original purchase price of the Software. The Vendor will not be liable for any general, special, incidental or consequential damages including, but not limited to, loss of production, loss of profits, loss of revenue, loss of data, or any other business or economic disadvantage suffered by the Licensee arising out of the use or failure to use the Software.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="10">The Vendor makes no warranty expressed or implied regarding the fitness of the Software for a particular purpose or that the Software will be suitable or appropriate for the specific requirements of the Licensee.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="11">The Vendor does not warrant that use of the Software will be uninterrupted or error-free. The Licensee accepts that software in general is prone to bugs and flaws within an acceptable level as determined in the industry.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Warrants and Representations</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="12">The Vendor warrants and represents that it is the copyright holder of the Software. The Vendor warrants and represents that granting the license to use this Software is not in violation of any other agreement, copyright or applicable statute.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Acceptance</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="13">All terms, conditions and obligations of this Agreement will be deemed to be accepted by the Licensee ("Acceptance") on registration of the Software with the Vendor.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">User Support</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="14">No user support or maintenance is provided as part of this Agreement.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Term</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="15">The term of this Agreement will begin on Acceptance and is perpetual.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Termination</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="16">This Agreement will be terminated and the License forfeited where the Licensee has failed to comply with any of the terms of this Agreement or is in breach of this Agreement. On termination of this Agreement for any reason, the Licensee will promptly destroy the Software or return the Software to the Vendor.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Force Majeure</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="17">The Vendor will be free of liability to the Licensee where the Vendor is prevented from executing its obligations under this Agreement in whole or in part due to Force Majeure, such as earthquake, typhoon, flood, fire, and war or any other unforeseen and uncontrollable event where the Vendor has taken any and all appropriate action to mitigate such an event.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Governing Law</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="18">The Parties to this Agreement submit to the jurisdiction of the courts of the State of California for the enforcement of this Agreement or any arbitration award or decision arising from this Agreement. This Agreement will be enforced or construed according to the laws of the State of California.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Miscellaneous</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="19">This Agreement can only be modified in writing signed by both the Vendor and the Licensee.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="20">This Agreement does not create or imply any relationship in agency or partnership between the Vendor and the Licensee.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="21">Headings are inserted for the convenience of the parties only and are not to be considered when interpreting this Agreement. Words in the singular mean and include the plural and vice versa. Words in the masculine gender include the feminine gender and vice versa. Words in the neuter gender include the masculine gender and the feminine gender and vice versa.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="22">If any term, covenant, condition or provision of this Agreement is held by a court of competent jurisdiction to be invalid, void or unenforceable, it is the parties' intent that such provision be reduced in scope by the court only to the extent deemed necessary by that court to render the provision reasonable and enforceable and the remainder of the provisions of this Agreement will in no way be affected, impaired or invalidated as a result.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="23">This Agreement contains the entire agreement between the parties. All understandings have been included in this Agreement. Representations which may have been made by any party to this Agreement may in some way be inconsistent with this final written Agreement. All such statements are declared to be of no value in this Agreement. Only the written terms of this Agreement will bind the parties.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:18.0pt;" value="24">This Agreement and the terms and conditions contained in this Agreement apply to and are binding upon the Vendor's successors and assigns.<span style="color:#000000;"><br></span>
                                    </li>
                                    <li class="lh" style="text-align:Left;margin-bottom:0.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Notices</span><span style="color:#000000;"><br></span>
                                    </li>
                                    <li style="margin-bottom:0.0pt;" value="25">All notices to the Vendor under this Agreement are to be provided at the following address:<br>FrendGrid: 1664 Marguerite Ave, CA, 92625<span style="color:#000000;"><br></span>
                                    </li>
                                </ol>

                        </div>


                            <a href="/legal">Terms of Use</a>

                        


                    </div>
                    <div class="card-footer">
                        @include('partials.footerlinks')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

